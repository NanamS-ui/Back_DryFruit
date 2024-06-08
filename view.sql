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
    w.reduction AS wholesale_reduction,
    b.movement_date AS bulk_date,
    b.price AS bulk_price,
    b.reduction AS bulk_reduction
FROM Product_Categories pc
LEFT JOIN stock s ON pc.product_id = s.id_product
LEFT JOIN detail_movement d ON pc.product_id = d.id_product
LEFT JOIN charges_kg_movement c ON pc.product_id = c.id_product
LEFT JOIN wholesale_movement w ON pc.product_id = w.id_product
LEFT JOIN bulk_movement b ON pc.product_id = b.id_product;

/*Detail des produits*/
SELECT 
    product_category,
    fruit_category,
    stock_quantity,
    charges_price,
    detail_price,
    detail_reduction,
    wholesale_price,
    wholesale_reduction,
    bulk_price,
    bulk_reduction
FROM 
    v_product_configuration;

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
    cc.id_client AS id_client,
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

/*Lists of pending baskets*/
 SELECT
                order_id,
                id_client,
                client_full_name,
                delivery_address
            FROM 
                v_delivery_info 
            WHERE 
                delivery_status = 0
            GROUP BY 
            order_id,client_full_name,
            delivery_address,
            delivery_status,
            id_client

/*Lists of delivered baskets*/
SELECT
                order_id,
                id_client,
                client_full_name,
                delivery_address
            FROM 
                v_delivery_info 
            WHERE 
                delivery_status = 1
            GROUP BY 
            order_id,client_full_name,
            delivery_address,
            delivery_status,
            id_client

/*Delivery management*/
SELECT 
            order_id,
            id_client,
            client_full_name,
            delivery_address
        FROM 
            v_delivery_info l
        WHERE 
            EXTRACT(MONTH FROM l.delivery_date) = ?
            AND EXTRACT(YEAR FROM l.delivery_date) = ?
        GROUP BY 
            order_id,client_full_name,
            delivery_address,
            id_client;

/*Basket-link-IDXXXXXX*/
    /*A propos du commande*/
        /*View Detail_Commande_Client */
        CREATE OR REPLACE VIEW v_client_orders_payment_delivery AS
        SELECT 
            c.id_client,
            c.full_name AS client_full_name,
            c.mail AS client_email,
            c.phone_number AS client_phone_number,
            c.user_image AS client_user_image,
            o.id_order,
            o.reduction AS order_reduction,
            o.ordering_date AS order_date,
            pm.id_payment,
            pm.payment_type,
            pm.card_number,
            pm.expiry_date,
            pm.cvv,
            d.id_delivery AS delivery_id,
            d.delivery_date AS delivery_date,
            d.delivery_address AS delivery_address,
            d.cost AS delivery_cost,
            d.status AS delivery_status
        FROM clients_account c
        LEFT JOIN orders o ON c.id_client = o.id_client
        LEFT JOIN payment_methods pm ON c.id_client = pm.id_client
        LEFT JOIN delivery d ON o.id_order = d.id_order;
        /*Requete Detail_Commande_Client selon id_order et id_client*/
        SELECT 
            client_full_name, 
            client_email, 
            client_phone_number, 
            delivery_address,
            payment_type, 
            card_number, 
            expiry_date, 
            cvv  
        FROM 
            v_client_orders_payment_delivery 
        WHERE 
            id_order = 'ORD0001' AND id_client = 'CTL0001';


    /*Compte facture*/
        /*View Detail_Commande_Client_Facture*/
        CREATE OR REPLACE VIEW v_order_delivery_link AS
        SELECT 
            l.id_delivery AS delivery_id,
            l.delivery_date AS delivery_date,
            l.delivery_address AS delivery_address,
            l.cost AS delivery_cost,
            l.status AS delivery_status,
            o.id_order AS order_id,
            o.reduction AS order_reduction,
            o.ordering_date AS order_date,
            cc.id_client AS client_id,  
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
            prt_c.fruit_category AS fruit_category,
            dm.price AS detail_price,
            wm.price AS wholesale_price,
            bm.price AS bulk_price
        FROM delivery l
        LEFT JOIN orders o ON l.id_order = o.id_order
        LEFT JOIN products_ordered po ON o.id_order = po.id_order
        LEFT JOIN product p ON po.id_product = p.id_product
        LEFT JOIN product_categories prt_c ON p.id_product = prt_c.product_id
        LEFT JOIN clients_account cc ON o.id_client = cc.id_client
        LEFT JOIN detail_movement dm ON p.id_product = dm.id_product
        LEFT JOIN wholesale_movement wm ON p.id_product = wm.id_product
        LEFT JOIN bulk_movement bm ON p.id_product = bm.id_product;
        /*Requete Detail_Commande_Client_Facture selon id_order*/
        WITH OrderDetails AS (
            SELECT 
                product_category, 
                fruit_category, 
                product_ordered_sales_type,
                product_ordered_quantity,
                CASE 
                    WHEN product_ordered_sales_type = 'D' THEN detail_price
                    WHEN product_ordered_sales_type = 'W' THEN wholesale_price
                    WHEN product_ordered_sales_type = 'B' THEN bulk_price
                    ELSE NULL
                END AS product_price,
                CASE 
                    WHEN product_ordered_sales_type = 'D' THEN detail_price * product_ordered_quantity
                    WHEN product_ordered_sales_type = 'W' THEN wholesale_price * product_ordered_quantity
                    WHEN product_ordered_sales_type = 'B' THEN bulk_price * product_ordered_quantity
                    ELSE NULL
                END AS total_price_product,
                order_reduction
            FROM v_order_delivery_link
            WHERE order_id = 'ORD0001' AND client_id = 'CTL0001'
        )
        SELECT 
            product_category, 
            fruit_category, 
            product_ordered_sales_type,
            product_ordered_quantity,
            product_price,
            total_price_product
        FROM OrderDetails;

        WITH Order_Details_Result AS (
        SELECT
            product_category,
            fruit_category,
            product_ordered_sales_type,
            product_ordered_quantity,
            CASE
                WHEN product_ordered_sales_type = 'D' THEN detail_price
                WHEN product_ordered_sales_type = 'W' THEN wholesale_price
                WHEN product_ordered_sales_type = 'B' THEN bulk_price
                ELSE NULL
            END AS product_price,
            CASE
                WHEN product_ordered_sales_type = 'D' THEN detail_price * product_ordered_quantity
                WHEN product_ordered_sales_type = 'W' THEN wholesale_price * product_ordered_quantity
                WHEN product_ordered_sales_type = 'B' THEN bulk_price * product_ordered_quantity
                ELSE NULL
            END AS total_price_product,
            order_reduction
        FROM v_order_delivery_link
        WHERE order_id = 'ORD0001' AND client_id = 'CTL0001'
        )
        SELECT
            order_reduction,
            SUM(total_price_product) AS total_order_price,
            SUM(total_price_product - (total_price_product * order_reduction / 100)) AS total_order_price_with_reduction
        FROM Order_Details_Result GROUP BY order_reduction;


SELECT
    SUM(quantity) / 0.1 AS number_package
FROM
    orders o
JOIN
    products_ordered po ON o.id_order = po.id_order
WHERE
    DATE(o.ordering_date) = '2023-06-01'  
    AND po.id_product = 1
    AND (sales_type = 'B' OR sales_type = 'D');

SELECT DISTINCT
    ckm.price
FROM
    charges_kg_movement ckm
JOIN
    products_ordered po ON ckm.id_product = po.id_product
WHERE
    ckm.id_product = 1  
    AND ckm.movement_date='2023-06-01';

SELECT
    SUM(
        CASE 
            WHEN po.sales_type = 'D' THEN dm.price * po.quantity
            WHEN po.sales_type = 'W' THEN wm.price * po.quantity
            WHEN po.sales_type = 'B' THEN bm.price * po.quantity
            ELSE 0
        END
    ) AS total_price
FROM
    orders o
JOIN
    products_ordered po ON o.id_order = po.id_order
LEFT JOIN
    detail_movement dm ON po.id_product = dm.id_product AND po.sales_type = 'D' AND DATE(o.ordering_date) = dm.movement_date
LEFT JOIN
    wholesale_movement wm ON po.id_product = wm.id_product AND po.sales_type = 'W' AND DATE(o.ordering_date) = wm.movement_date
LEFT JOIN
    bulk_movement bm ON po.id_product = bm.id_product AND po.sales_type = 'B' AND DATE(o.ordering_date) = bm.movement_date
WHERE
    DATE(o.ordering_date) = '2023-06-01'
    AND po.id_product = 1;


