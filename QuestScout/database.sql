SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE admins (  user_id int(10) NOT NULL,
  user_email varchar(255) NOT NULL,  user_pass varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO admins (`user_id`, user_email, `user_pass`) VALUES(2, 'PZPI', '123');

CREATE TABLE cart (
  p_id int(10) NOT NULL,  ip_add varchar(255) NOT NULL,
  qty int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE categories (
  cat_id int(100) NOT NULL,  cat_title text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO categories (`cat_id`, `cat_title`);

CREATE TABLE customers (  customer_id int(10) NOT NULL,
  customer_ip varchar(255) NOT NULL,  customer_name text NOT NULL,
  customer_email varchar(100) NOT NULL,  customer_pass varchar(100) NOT NULL,
  c_passport varchar(100) NOT NULL,  customer_country text NOT NULL,
  customer_city text NOT NULL,  customer_contact varchar(255) NOT NULL,
  customer_address text NOT NULL,  customer_image text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO customers (`customer_id`, customer_ip, customer_name, customer_email, customer_pass, c_passport, customer_country, customer_city, customer_contact, customer_address, `customer_image`) VALUES
(1, '::1', 'Misha', 'misha@gmail.com', '12345', 'aaa', 'Ukraine', 'Kyiv', '09876543', '12 Lisova Street', 'Misha.jpg'),
(2, '::1', 'Tolia', 'bale@gmail.com', '123456', 'bbb', 'Ukraine', 'Lviv', '1234678', '34 Svobody Avenue', 'Tolia.jpg'),
(3, '::1', 'Polina', 'imrose@gmail.com', '1234567', 'ccc', 'Ukraine', 'Odesa', '987654321', '101 Dniprovska Street', 'Polina.jpg');

CREATE TABLE employees (  emp_id int(100) NOT NULL,
  emp_name varchar(100) NOT NULL,  emp_email varchar(100) NOT NULL,
  emp_designation varchar(100) NOT NULL,  emp_location varchar(100) NOT NULL,
  emp_address varchar(255) NOT NULL,  emp_contact varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO employees (`emp_id`, emp_name, emp_email, emp_designation, emp_location, emp_address, `emp_contact`) VALUES
(1, 'Ivan Tovstukha', 'ivan.tovstukha@nure.ua', 'Nure Student', 'Ukraine', '12 Lisova Street, Kyiv', '+380 44 123 4567'),
(2, 'Timofey Kuzmenko', 'tymofii.kuzmenko@nure.ua', 'Nure Student', 'Ukraine', '34 Svobody Avenue, Lviv', '+380 32 234 5678'),
(3, 'Miroslav Los', 'myroslav.los@nure.ua', 'Nure Student', 'Ukraine', '56 Sonyachna Street, Odesa', '+380 48 345 6789'),
(4, 'Egor Fatyanov', 'yehor.fatianov@nure.ua', 'Nure Student', 'Ukraine', '78 Kvitkova Street, Kharkiv', '+380 57 456 7890'),
(5, 'Ruslan Siryak', 'ruslan.siriak@nure.ua', 'Nure Student', 'Ukraine', '101 Dniprovska Street, Dnipro', '+380 56 567 8901');

CREATE TABLE packages (
  package_id int(100) NOT NULL,  package_cat int(100) NOT NULL,
  package_type int(100) NOT NULL,  package_title varchar(255) NOT NULL,
  package_price int(100) NOT NULL,  package_desc longtext NOT NULL,
  package_image text NOT NULL,  package_keywords varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE types (  type_id int(100) NOT NULL,
  type_title text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO types (`type_id`, `type_title`) VALUES;

ALTER TABLE admins  ADD PRIMARY KEY (`user_id`);
ALTER TABLE cart  ADD PRIMARY KEY (`p_id`);
ALTER TABLE categories  ADD PRIMARY KEY (`cat_id`);
ALTER TABLE customers  ADD PRIMARY KEY (`customer_id`);
ALTER TABLE employees  ADD PRIMARY KEY (`emp_id`);
ALTER TABLE packages  ADD PRIMARY KEY (`package_id`);
ALTER TABLE types  ADD PRIMARY KEY (`type_id`);

ALTER TABLE admins  MODIFY user_id int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE categories  MODIFY cat_id int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE customers  MODIFY customer_id int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
ALTER TABLE employees  MODIFY emp_id int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
ALTER TABLE packages  MODIFY package_id int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
ALTER TABLE `types`  MODIFY type_id int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
