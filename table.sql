CREATE TABLE cat_product(
   id_cat_product SERIAL,
   wording VARCHAR(20)  NOT NULL,
   PRIMARY KEY(id_cat_product),
   UNIQUE(wording)
);

CREATE TABLE cat_fruit(
   id_cat_fruit SERIAL,
   wording VARCHAR(25)  NOT NULL,
   PRIMARY KEY(id_cat_fruit),
   UNIQUE(wording)
);

CREATE TABLE Product(
   id_product SERIAL,
   image_link VARCHAR(50)  NOT NULL,
   description VARCHAR(75) ,
   creation_date DATE,
   id_cat_product INTEGER NOT NULL,
   id_cat_fruit INTEGER NOT NULL,
   PRIMARY KEY(id_product),
   FOREIGN KEY(id_cat_product) REFERENCES cat_product(id_cat_product),
   FOREIGN KEY(id_cat_fruit) REFERENCES cat_fruit(id_cat_fruit)
);

CREATE TABLE stock(
   id_stock VARCHAR(50) DEFAULT ('STK') || LPAD(nextval('stock_sequence')::TEXT, 4, '0'),
   renewal_date TIMESTAMP,
   quantity_kg NUMERIC(9,2)   NOT NULL,
   id_product INTEGER NOT NULL,
   PRIMARY KEY(id_stock),
   FOREIGN KEY(id_product) REFERENCES Product(id_product)
);

CREATE TABLE clients_account(
   id_client VARCHAR(20) DEFAULT ('CTL') || LPAD(nextval('client_account_sequence')::TEXT, 4, '0'),
   full_name VARCHAR(100)  NOT NULL,
   mail VARCHAR(50) ,
   password VARCHAR(50)  NOT NULL,
   phone_number VARCHAR(20)  NOT NULL,
   PRIMARY KEY(id_client)
);
ALTER TABLE clients_account
ADD COLUMN user_image VARCHAR(30);
ALTER COLUMN password TYPE VARCHAR(225);


CREATE TABLE administrators(
   id_admin SERIAL,
   pseudo_name VARCHAR(25) ,
   password VARCHAR(50)  NOT NULL,
   PRIMARY KEY(id_admin),
   UNIQUE(pseudo_name)
);
ALTER TABLE administrators
ALTER COLUMN password TYPE VARCHAR(225);

CREATE TABLE client_favorite_products(
   id_client_favorite_products VARCHAR(50) DEFAULT ('FAV') || LPAD(nextval('client_favorite_products_sequence')::TEXT, 4, '0'),
   id_client VARCHAR(20)  NOT NULL,
   id_product INTEGER NOT NULL,
   PRIMARY KEY(id_client_favorite_products),
   FOREIGN KEY(id_client) REFERENCES clients_account(id_client),
   FOREIGN KEY(id_product) REFERENCES Product(id_product)
);

CREATE TABLE detail_movement(
   id_detail_movement VARCHAR(50) DEFAULT ('MVD') || LPAD(nextval('mouvementt_detail_sequence')::TEXT, 4, '0'),
   movement_date DATE,
   price NUMERIC(14,2)  ,
   reduction SMALLINT,
   id_product INTEGER NOT NULL,
   PRIMARY KEY(id_detail_movement),
   FOREIGN KEY(id_product) REFERENCES Product(id_product)
);

CREATE TABLE wholesale_movement(
   id_wholesale_movement VARCHAR(50) DEFAULT ('MVW') || LPAD(nextval('mouvement_wholesale_sequence')::TEXT, 4, '0'),
   movement_date DATE,
   price NUMERIC(14,2)  ,
   reduction SMALLINT,
   id_product INTEGER NOT NULL,
   PRIMARY KEY(id_wholesale_movement),
   FOREIGN KEY(id_product) REFERENCES Product(id_product)
);

CREATE TABLE bulk_movement  (
   id_bulk_movement VARCHAR(50) DEFAULT ('MVB') || LPAD(nextval('mouvement_bulk_sequence')::TEXT, 4, '0'),
   movement_date DATE,
   price NUMERIC(14,2)  ,
   reduction SMALLINT,
   id_product INTEGER NOT NULL,
   PRIMARY KEY(id_bulk_movement),
   FOREIGN KEY(id_product) REFERENCES Product(id_product)
);

CREATE TABLE charges_kg_movement(
   id_charges_movement VARCHAR(50) DEFAULT ('MVC') || LPAD(nextval('mouvement_charges_sequence')::TEXT, 4, '0'),
   movement_date DATE,
   price NUMERIC(14,2)  ,
   id_product INTEGER NOT NULL,
   PRIMARY KEY(id_charges_movement),
   FOREIGN KEY(id_product) REFERENCES Product(id_product)
);

CREATE TABLE orders(
   id_order VARCHAR(35) DEFAULT ('ORD') || LPAD(nextval('ordered_product_sequence')::TEXT, 4, '0'),
   reduction SMALLINT,
   ordering_date TIMESTAMP,
   id_client VARCHAR(20)  NOT NULL,
   PRIMARY KEY(id_order),
   FOREIGN KEY(id_client) REFERENCES clients_account(id_client)
);

CREATE TABLE delivery(
   id_delivery VARCHAR(50) DEFAULT ('DLV') || LPAD(nextval('delivery_sequence')::TEXT, 4, '0'),
   delivery_date TIMESTAMP,
   delivery_address VARCHAR(50)  NOT NULL,
   cost NUMERIC(10,2)   NOT NULL,
   status SMALLINT NOT NULL,
   id_order VARCHAR(35)  NOT NULL,
   PRIMARY KEY(id_delivery),
   FOREIGN KEY(id_order) REFERENCES orders(id_order)
);

CREATE TABLE products_ordered(
   id_product_ordered VARCHAR(75) DEFAULT ('PRO') || LPAD(nextval('products_ordered_sequence')::TEXT, 4, '0'),
   sales_type CHAR(1) ,
   quantity NUMERIC(14,2)  ,
   id_order VARCHAR(35)  NOT NULL,
   id_product INTEGER NOT NULL,
   PRIMARY KEY(id_product_ordered),
   FOREIGN KEY(id_order) REFERENCES orders(id_order),
   FOREIGN KEY(id_product) REFERENCES Product(id_product)
);

CREATE TABLE payment_methods (
    id_payment SERIAL PRIMARY KEY,
    id_client VARCHAR(20) NOT NULL,
    payment_type VARCHAR(50) NOT NULL,
    card_number VARCHAR(16),
    expiry_date DATE,
    cvv VARCHAR(3),
    FOREIGN KEY (id_client) REFERENCES clients_account(id_client)
);
