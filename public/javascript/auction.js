// list of stock ids we are buying
var min_length = 0;
var purchases = [];
var last_query = "";
var last_selected = "";
var timeout;

var KEY = {
	UP: 38,
	DOWN: 40,
	DEL: 46,
	TAB: 9,
	RETURN: 13,
	ESC: 27,
	COMMA: 188,
	PAGEUP: 33,
	PAGEDOWN: 34,
	BACKSPACE: 8
};


function handleType(event) {
  if (last_selected != "") {
    switch(event.keyCode) {
      case KEY.UP:
	last_option = $('option#'+last_selected);
	next_option = last_option.prev()
	if(next_option.length > 0 ) {	
	  last_option.removeAttr('selected');
	  next_option.attr('selected','selected');
	  last_selected = next_option.attr('id');
	}
	break;
      case KEY.DOWN:
	last_option = $('option#'+last_selected);
	next_option = last_option.next();
	if(next_option.length > 0 ) {
	  last_option.removeAttr('selected');
	  next_option.attr('selected','selected');
	  last_selected = next_option.attr('id');
	}
	break;
      case KEY.RETURN:
	selected_option = $('select#storefront option:selected');
	buyer(selected_option);
	break;
      default:
	clearTimeout(timeout);
	timeout = setTimeout(suggest, .1);
	break;
    }
  }
}

function deleter(event) {
  id = $(this).attr('id');
  cart[id] -=1;
  $(this).remove();
  clearTimeout(timeout);
  timeout = setTimeout(suggest, .1);
  update_price();
}

function buy_click(event) {
  buyer($(this));
}

function update_price() {
  total = 0.0;
  $('select#cart option').each(function(){
    total +=  parseFloat($(this).attr('price'));
  });
  $('span#total').html(total);
}

function buyer(option) {
  item_id = option.attr('id');
  copy_selected_option = option.clone();
  copy_selected_option.removeAttr('selected');
  $('select#cart').append(copy_selected_option);
  copy_selected_option.click(deleter);
  if (item_id in cart) {
    cart[item_id]+=1;
  } else {
    cart[item_id]=1;
  }
  clearTimeout(timeout);
  timeout = setTimeout(suggest, .1);
  update_price();
}

function suggest() {
  query = $('#item-search').val();
  if(query.length < min_length) {
    query = "";
  }
  //if(query != last_query && !override){ 
    $.ajax({
      dataType: 'json', 
      url: 'stock_suggest.php',
      data: ({q : query}),
    success: function(data) {
      populate(screen(data));
    }
    });
    last_query = query;
  //}
}

// map from ids to counts of how many we bought
var cart = {};

function screen(data) {
  screened_data = {};
  // this basically runs the auction
  $.each(data, function(key, item) { 
    in_stock = true;
    if (item['id'] in cart) {
      // we have to check if it is still in stock
      if (item['quantity'] - cart[item['id']] <= 0) {
	in_stock = false;
      }
    }
    if(in_stock) {
      // we now assume that we can buy the item
      // have we seen an item of this type before?
      if (!(item['item_id'] in screened_data)) {
	screened_data[item['item_id']] = item;
      } else {
	if ( parseFloat(screened_data[item['item_id']]['price']) >  parseFloat(item['price'])){	
	  screened_data[item['item_id']] = item;
	}
      }
    }
  });

  return screened_data;
}



function populate(data) {
  // we have a list of arrays of dicts
  // one for each item id
  // we convert them to options
  selected = false;
  store = $('select#storefront');
  store.html('');
  $.each(data, function(key, item) { 
    if(item!== undefined){
      option = $("<option value='"+item['id']+"'>" + item['text'] + "</option>");
      option.attr("id",  item['id']);
      option.attr("price",item['price']);
      option.keypress(handleType);
      option.dblclick(buy_click);
      if (last_selected == item['id']) {	
	option.attr("selected", "selected");
	selected = true;
      }
      store.append(option);
    }
  });
  if (!selected) {
    $('select#storefront option:first-child').attr("selected", "selected");
    last_selected = $('select#storefront option:first-child').attr('id');
    selected = true;
  }
  return data;
}
