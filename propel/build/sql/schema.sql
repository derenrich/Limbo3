
-----------------------------------------------------------------------------
-- user
-----------------------------------------------------------------------------

DROP TABLE [user];


CREATE TABLE [user]
(
	[id] INTEGER  NOT NULL PRIMARY KEY,
	[username] VARCHAR(255)  NOT NULL,
	[real_name] VARCHAR(255),
	[email] VARCHAR(255),
	[balance] DOUBLE default 0 NOT NULL,
	[created] TIMESTAMP default current_timestamp,
	UNIQUE ([username])
);

-----------------------------------------------------------------------------
-- item
-----------------------------------------------------------------------------

DROP TABLE [item];


CREATE TABLE [item]
(
	[id] INTEGER  NOT NULL PRIMARY KEY,
	[name] VARCHAR(255)  NOT NULL,
	[UPC] VARCHAR(255),
	[created] TIMESTAMP default current_timestamp
);

-----------------------------------------------------------------------------
-- stock
-----------------------------------------------------------------------------

DROP TABLE [stock];


CREATE TABLE [stock]
(
	[id] INTEGER  NOT NULL PRIMARY KEY,
	[item_id] INTEGER  NOT NULL,
	[user_id] INTEGER  NOT NULL,
	[price] DOUBLE  NOT NULL,
	[created] TIMESTAMP default current_timestamp,
	[sold_out] INTEGER default 0,
	[quantity] INTEGER  NOT NULL,
	[sold] INTEGER default 0 NOT NULL
);

CREATE INDEX [stock_I_1] ON [stock] ([item_id]);

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([item_id]) REFERENCES item ([id])

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([user_id]) REFERENCES user ([id])

-----------------------------------------------------------------------------
-- purchase
-----------------------------------------------------------------------------

DROP TABLE [purchase];


CREATE TABLE [purchase]
(
	[id] INTEGER  NOT NULL PRIMARY KEY,
	[user_id] INTEGER  NOT NULL,
	[stock_id] INTEGER  NOT NULL,
	[item_id] INTEGER  NOT NULL,
	[quantity] INTEGER  NOT NULL,
	[created] TIMESTAMP default current_timestamp,
	[price] DOUBLE  NOT NULL
);

CREATE INDEX [purchase_I_1] ON [purchase] ([item_id]);

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([user_id]) REFERENCES user ([id])

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([stock_id]) REFERENCES stock ([id])

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([item_id]) REFERENCES item ([id])

-----------------------------------------------------------------------------
-- deposit
-----------------------------------------------------------------------------

DROP TABLE [deposit];


CREATE TABLE [deposit]
(
	[id] INTEGER  NOT NULL PRIMARY KEY,
	[user_id] INTEGER  NOT NULL,
	[amount] DOUBLE  NOT NULL
);

-----------------------------------------------------------------------------
-- transfer
-----------------------------------------------------------------------------

DROP TABLE [transfer];


CREATE TABLE [transfer]
(
	[id] INTEGER  NOT NULL PRIMARY KEY,
	[from] INTEGER  NOT NULL,
	[to] INTEGER  NOT NULL,
	[amount] DOUBLE  NOT NULL,
	[reason] VARCHAR(255) default '',
	[created] TIMESTAMP default current_timestamp
);

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([from]) REFERENCES user ([id])

-- SQLite does not support foreign keys; this is just for reference
-- FOREIGN KEY ([to]) REFERENCES user ([id])
