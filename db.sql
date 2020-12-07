DROP DATABASE IF EXISTS spreadthelove;
CREATE DATABASE spreadthelove;

USE spreadthelove;

DROP TABLE IF EXISTS receiver;
CREATE TABLE receiver (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS love;
CREATE TABLE love (
  id_receiver INT NOT NULL,
  sender VARCHAR(100) NOT NULL,
  content text NOT NULL,
  KEY fk_love_receiver (id_receiver),
  CONSTRAINT fk_love_receiver FOREIGN KEY (id_receiver) REFERENCES receiver (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;