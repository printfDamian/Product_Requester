USE requester;

ALTER TABLE products 
ADD CONSTRAINT products_states FOREIGN KEY (`status_id`)
REFERENCES status(id);

ALTER TABLE products 
ADD CONSTRAINT products_clients FOREIGN KEY (`client_id`)
REFERENCES clients(id);

ALTER TABLE votos
ADD CONSTRAINT votos_clients FOREIGN KEY (`client_id`)
REFERENCES clients(id);

ALTER TABLE votos 
ADD CONSTRAINT votos_products FOREIGN KEY (`product_id`)
REFERENCES products(id);
    
    