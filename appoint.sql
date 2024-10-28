CREATE TABLE `appointments` (
    `appointment_id` INT(11) NOT NULL AUTO_INCREMENT,
    `patient_id` INT(11) NOT NULL,
    `doctor_name` VARCHAR(100) NOT NULL,
    `appointment_date` DATE NOT NULL,
    `health_issue` TEXT NOT NULL,
    PRIMARY KEY (`appointment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
