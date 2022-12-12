CREATE DATABASE /*!32312 IF NOT EXISTS*/`laundry` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `laundry`;

DROP TABLE IF EXISTS `user`;

create table laundryuser(
userID int(4) primary key not null auto_increment,
username varchar(45) NOT NULL,
password varchar(45) NOT NULL,
type tinyint(2) NOT NULL
);

insert into laundryuser values(null, "admin", "321", 1);

DROP TABLE IF EXISTS `schedule`;
create table schedule(
scheduleID int(4) primary key not null auto_increment,
Day varchar(16) not null,
ScheduledTime varchar(16) not null
);

insert into schedule values(null, "Monday", "00:00-02:00");
insert into schedule values(null, "Monday", "02:00-04:00");
insert into schedule values(null, "Monday", "04:00-06:00");
insert into schedule values(null, "Monday", "06:00-08:00");
insert into schedule values(null, "Monday", "08:00-10:00");
insert into schedule values(null, "Monday", "10:00-12:00");
insert into schedule values(null, "Monday", "12:00-14:00");
insert into schedule values(null, "Monday", "14:00-16:00");
insert into schedule values(null, "Monday", "16:00-18:00");
insert into schedule values(null, "Monday", "18:00-20:00");
insert into schedule values(null, "Monday", "20:00-22:00");
insert into schedule values(null, "Monday", "22:00-24:00");
insert into schedule values(null, "Tuesday", "00:00-02:00");
insert into schedule values(null, "Tuesday", "02:00-04:00");
insert into schedule values(null, "Tuesday", "04:00-06:00");
insert into schedule values(null, "Tuesday", "06:00-08:00");
insert into schedule values(null, "Tuesday", "08:00-10:00");
insert into schedule values(null, "Tuesday", "10:00-12:00");
insert into schedule values(null, "Tuesday", "12:00-14:00");
insert into schedule values(null, "Tuesday", "14:00-16:00");
insert into schedule values(null, "Tuesday", "16:00-18:00");
insert into schedule values(null, "Tuesday", "18:00-20:00");
insert into schedule values(null, "Tuesday", "20:00-22:00");
insert into schedule values(null, "Tuesday", "22:00-24:00");
insert into schedule values(null, "Wednesday", "00:00-02:00");
insert into schedule values(null, "Wednesday", "02:00-04:00");
insert into schedule values(null, "Wednesday", "04:00-06:00");
insert into schedule values(null, "Wednesday", "06:00-08:00");
insert into schedule values(null, "Wednesday", "08:00-10:00");
insert into schedule values(null, "Wednesday", "10:00-12:00");
insert into schedule values(null, "Wednesday", "12:00-14:00");
insert into schedule values(null, "Wednesday", "14:00-16:00");
insert into schedule values(null, "Wednesday", "16:00-18:00");
insert into schedule values(null, "Wednesday", "18:00-20:00");
insert into schedule values(null, "Wednesday", "20:00-22:00");
insert into schedule values(null, "Wednesday", "22:00-24:00");
insert into schedule values(null, "Thursday", "00:00-02:00");
insert into schedule values(null, "Thursday", "02:00-04:00");
insert into schedule values(null, "Thursday", "04:00-06:00");
insert into schedule values(null, "Thursday", "06:00-08:00");
insert into schedule values(null, "Thursday", "08:00-10:00");
insert into schedule values(null, "Thursday", "10:00-12:00");
insert into schedule values(null, "Thursday", "12:00-14:00");
insert into schedule values(null, "Thursday", "14:00-16:00");
insert into schedule values(null, "Thursday", "16:00-18:00");
insert into schedule values(null, "Thursday", "18:00-20:00");
insert into schedule values(null, "Thursday", "20:00-22:00");
insert into schedule values(null, "Thursday", "22:00-24:00");
insert into schedule values(null, "Friday", "00:00-02:00");
insert into schedule values(null, "Friday", "02:00-04:00");
insert into schedule values(null, "Friday", "04:00-06:00");
insert into schedule values(null, "Friday", "06:00-08:00");
insert into schedule values(null, "Friday", "08:00-10:00");
insert into schedule values(null, "Friday", "10:00-12:00");
insert into schedule values(null, "Friday", "12:00-14:00");
insert into schedule values(null, "Friday", "14:00-16:00");
insert into schedule values(null, "Friday", "16:00-18:00");
insert into schedule values(null, "Friday", "18:00-20:00");
insert into schedule values(null, "Friday", "20:00-22:00");
insert into schedule values(null, "Friday", "22:00-24:00");
insert into schedule values(null, "Saturday", "00:00-02:00");
insert into schedule values(null, "Saturday", "02:00-04:00");
insert into schedule values(null, "Saturday", "04:00-06:00");
insert into schedule values(null, "Saturday", "06:00-08:00");
insert into schedule values(null, "Saturday", "08:00-10:00");
insert into schedule values(null, "Saturday", "10:00-12:00");
insert into schedule values(null, "Saturday", "12:00-14:00");
insert into schedule values(null, "Saturday", "14:00-16:00");
insert into schedule values(null, "Saturday", "16:00-18:00");
insert into schedule values(null, "Saturday", "18:00-20:00");
insert into schedule values(null, "Saturday", "20:00-22:00");
insert into schedule values(null, "Saturday", "22:00-24:00");
insert into schedule values(null, "Sunday", "00:00-02:00");
insert into schedule values(null, "Sunday", "02:00-04:00");
insert into schedule values(null, "Sunday", "04:00-06:00");
insert into schedule values(null, "Sunday", "06:00-08:00");
insert into schedule values(null, "Sunday", "08:00-10:00");
insert into schedule values(null, "Sunday", "10:00-12:00");
insert into schedule values(null, "Sunday", "12:00-14:00");
insert into schedule values(null, "Sunday", "14:00-16:00");
insert into schedule values(null, "Sunday", "16:00-18:00");
insert into schedule values(null, "Sunday", "18:00-20:00");
insert into schedule values(null, "Sunday", "20:00-22:00");
insert into schedule values(null, "Sunday", "22:00-24:00");



DROP TABLE IF EXISTS `booking`;
create table booking(
bookingID int(4) primary key not null auto_increment,
FK_userId int(4) not null,
FK_scheduleId int(4) not null,
CreateTime datetime not null,
ExpiredTime datetime not null,
constraint FK_userId foreign key (FK_userId) references laundryuser (userId),
constraint FK_scheduleId foreign key (FK_scheduleId) references schedule (scheduleId)
);



