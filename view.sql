CREATE OR REPLACE VIEW v_product_categories AS
SELECT 
    p.id_product AS product_id,
    p.image_link AS product_image_link,
    p.description AS product_description,
    p.creation_date AS product_creation_date,
    cp.wording AS product_category,
    cf.wording AS fruit_category
FROM Product p
INNER JOIN cat_product cp ON p.id_cat_product = cp.id_cat_product
INNER JOIN cat_fruit cf ON p.id_cat_fruit = cf.id_cat_fruit;

CREATE OR REPLACE VIEW v_product_configuration AS
SELECT 
    pc.product_id,
    pc.product_image_link,
    pc.product_description,
    pc.product_creation_date,
    pc.product_category,
    pc.fruit_category,
    s.renewal_date AS stock_renewal_date,
    s.quantity_kg AS stock_quantity,
    d.movement_date AS detail_date,
    d.price AS detail_price,
    d.reduction AS detail_reduction,
    c.movement_date AS charges_date,
    c.price AS charges_price,
    w.movement_date AS wholesale_date,
    w.price AS wholesale_price,
    b.movement_date AS bulk_date,
    b.price AS bulk_price
FROM Product_Categories pc
LEFT JOIN stock s ON pc.product_id = s.id_product
LEFT JOIN detail_movement d ON pc.product_id = d.id_product
LEFT JOIN charges_kg_movement c ON pc.product_id = c.id_product
LEFT JOIN wholesale_movement w ON pc.product_id = w.id_product
LEFT JOIN bulk_movement b ON pc.product_id = b.id_product;

/*Detail des produits*/
select product_category,fruit_category,stock_quantity,charges_price,detail_price,wholesale_price,bulk_price from v_product_configuration;

CREATE OR REPLACE VIEW v_delivery_info AS
SELECT 
    l.id_delivery AS delivery_id,
    l.delivery_date AS delivery_date,
    l.delivery_address AS delivery_address,
    l.cost AS delivery_cost,
    l.status AS delivery_status,
    o.id_order AS order_id,
    o.reduction AS order_reduction,
    o.ordering_date AS order_date,
    cc.full_name AS client_full_name,
    cc.mail AS client_email,
    cc.phone_number AS client_phone_number,
    po.sales_type AS product_ordered_sales_type,
    po.quantity AS product_ordered_quantity,
    p.id_product AS product_id,
    p.image_link AS product_image_link,
    p.description AS product_description,
    p.creation_date AS product_creation_date,
    prt_c.product_category AS product_category,
    prt_c.fruit_category AS fruit_category
FROM delivery l
LEFT JOIN orders o ON l.id_order = o.id_order
LEFT JOIN products_ordered po ON o.id_order = po.id_order
LEFT JOIN Product p ON po.id_product = p.id_product
LEFT JOIN Product_Categories prt_c ON p.id_product = prt_c.product_id
LEFT JOIN clients_account cc ON o.id_client = cc.id_client;

/*Produit livraison en attente*/
SELECT 
    delivery_date, 
    delivery_address 
FROM 
    v_delivery_info 
WHERE 
    delivery_status = 0;
/*Produit livrer*/
SELECT 
    delivery_date, 
    delivery_address 
FROM 
    v_delivery_info 
WHERE 
    delivery_status = 1;

/*Livraison Info*/
SELECT 
    cc.full_name AS client_full_name,
    l.delivery_address AS delivery_address,
    p.description AS product_description,
    l.status AS delivery_status
FROM 
    delivery l
INNER JOIN 
    orders o ON l.id_order = o.id_order
INNER JOIN 
    clients_account cc ON o.id_client = cc.id_client
INNER JOIN 
    products_ordered po ON o.id_order = po.id_order
INNER JOIN 
    Product p ON po.id_product = p.id_product
WHERE 
    EXTRACT(MONTH FROM l.delivery_date) = 6 
    AND EXTRACT(YEAR FROM l.delivery_date) = 2023;
