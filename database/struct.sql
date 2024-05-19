
CREATE TABLE IF NOT EXISTS `customers` (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  lastname VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  status BOOLEAN NOT NULL DEFAULT TRUE,
  createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  createdBy INT,
  updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  updatedBy INT,
  FOREIGN KEY (createdBy) REFERENCES customers(id),
  FOREIGN KEY (updatedBy) REFERENCES customers(id)
);

-- INSERT INTO `customers` ( name, lastName, email, password )
-- VALUES ( 'Pxndxs', 'Last Pxndxs', 'pxndxs@pxndxs.com', '123456' );

