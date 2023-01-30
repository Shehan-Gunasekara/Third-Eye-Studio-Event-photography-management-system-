create table Client(
	ClientID int(5) not null  auto_increment,
	First_name varchar(30), 
	Last_name varchar(30),  
	Address varchar(200),
	Date_of_birth date,
	Username varchar(20),
	Password varchar(20),
	constraint client_pk primary key(ClientID)
);

create table Employee(
	EmployeeID int(4) not null  auto_increment,
	First_name varchar(30), 
	Last_name varchar(30),  
	Address varchar(200),
	Date_of_birth date,
	position varchar(20),
	Username varchar(20),
	Password varchar(20),
	constraint employee_pk primary key(EmployeeID)
);

create table Administrator(
	AdministratorID int(3) not null  auto_increment,
	First_name varchar(30), 
	Last_name varchar(30),  
	Address varchar(200),
	Date_of_birth date,
	Username varchar(20),
	Password varchar(20),
	constraint administrator_pk primary key(AdministratorID)
);

create table Employee_mobile_number(
	Mobile_number char(10),
	EmployeeID int(4),
	constraint employee_mobile_number_pk primary key(Mobile_number, EmployeeID),
	constraint employee_mobile_number_fk foreign key (EmployeeID) references Employee(EmployeeID)
);

create table Employee_email(
	Email varchar(50),
	EmployeeID int(4),
	constraint employee_email_pk primary key(Email, EmployeeID),
	constraint employee_email_fk foreign key (EmployeeID) references Employee(EmployeeID)
);

create table Administrator_mobile_number(
	Mobile_number char(10),
	AdministratorID int(3),
	constraint administrator_mobile_number_pk primary key(Mobile_number, AdministratorID),
	constraint administrator_mobile_number_fk foreign key (AdministratorID) references Administrator(AdministratorID)
);

create table Administrator_email(
	Email varchar(50),
	AdministratorID int(3),
	constraint administrator_email_pk primary key(Email, AdministratorID),
	constraint administrator_email_fk foreign key (AdministratorID) references Administrator(AdministratorID)
);

create table Client_mobile_number(
	Mobile_number char(10),
	ClientID int(5),
	constraint client_mobile_number_pk primary key(Mobile_number, ClientID),
	constraint client_mobile_number_fk foreign key (ClientID) references Client(ClientID)
);

create table Client_email(
	Email varchar(50),
	ClientID int(5),
	constraint client_email_pk primary key(Email, ClientID),
	constraint client_email_fk foreign key (ClientID) references Client(ClientID)
);

create table Event_tb(
	EventID int(3) not null  auto_increment,
	Event_type varchar(20),
	Description varchar(500),
	constraint event_pk primary key(EventID)
);

create table Package(
	PackageID int(3) not null  auto_increment,
	Name varchar(20),
	Price float,
	constraint package_pk primary key(PackageID)
);

create table Feature(
	FeatureID int(3) not null  auto_increment,
	Feature_description varchar(50),
	constraint feature_pk primary key(FeatureID)
);

create table Package_feature(
	PackageID int(3),
	FeatureID int(3),
	constraint Package_feature_pk primary key(PackageID, FeatureID),
	constraint Package_feature_packageid_fk foreign key (PackageID) references Package(PackageID),
	constraint Package_feature_featureid_fk foreign key (FeatureID) references Feature(FeatureID)
);

create table Event_package(
	EventID int(3),
	PackageID int(3),
	constraint event_Package_pk primary key(EventID, PackageID),
	constraint event_package_eventid_fk foreign key (EventID) references Event_tb(EventID),
	constraint event_package_packageid_fk foreign key (PackageID) references Package(PackageID)
);

create table Booking(
	BookingID int(3) not null  auto_increment, 
	ClientID int(5), 
	EventID int(3), 
	PackageID int(3), 
	event_date date, 
	Payment_state varchar(20), 
	Progress varchar(20),
	constraint booking_pk primary key(BookingID),
	constraint booking_client_fk foreign key (ClientID) references Client(ClientID),
	constraint booking_event_fk foreign key (EventID) references Event_tb(EventID),
	constraint booking_package_fk foreign key (PackageID) references Package(PackageID)
);

create table Album(
	BookingID int(3), 
	Album_name varchar(30),
	constraint album_pk primary key(BookingID, Album_name),
	constraint album_fk foreign key (BookingID) references Booking(BookingID)
);

create table Booking_employee(
	BookingID int(3), 
	EmployeeID int(4), 
	constraint booking_employee_pk primary key(BookingID, EmployeeID),
	constraint booking_employee_bookingid_fk foreign key (BookingID) references Booking(BookingID),
	constraint booking_employee_employeeid_fk foreign key (EmployeeID) references Employee(EmployeeID)
);

insert into Client
values (1, 'Yashmi', 'Munaweera', 'No.23, Housing scheme, Kiribathgoda', '2000-04-05' ,'Yash_M' , 'Yash_M2000');
insert into Client
values (2, 'Chamath', 'Wijesinghe', '763, Ragama road, Kadawatha', '1997-04-12', 'Chamath_CK', 'Chamoo2025');
insert into Client
values (3, 'Keshal', 'Samarakkodi', 'No.50, Orien City, Mount Laviniya', '1994-10-02', 'Keshal_KK', 'KeshalKK2019');
insert into Client
values (4, 'Udara', 'Udawatha', 'No.254, Kiribathkumbura lane, Thissamaharama', '2001-11-12', 'Udara_a2', 'Udaradesh12');
insert into Client
values (5, 'Sahan', 'Thilarathne', '436/G, New Rajagitiya road, Rajagiriya', '2000-12-11', 'Sahan_fos', 'SahanF12');

insert into Employee
values (1, 'Ashen', 'Weerasinghe', 'No122, Rose street, matale', '1995-05-12', 'Photographer', 'EWashen', 'Ashen1234');
insert into Employee
values (2, 'Subath', 'Wijesinghe', 'No678 , 3rd new lane,Maharahgama', '1998-03-12','Photographer', 'EWsubath', 'Subath1234');
insert into Employee
values (3,'Vajira', 'Perera', 'No965 , 1st new lane,Kottawa', '1994-07-22', 'Photographer', 'MPvajira', 'Vajira1234');
insert into Employee
values (4,'Hsitha', 'Bandara', 'No655 , 2nd new lane,Kottawa', '1995-12-13', 'Manager', 'MBhasitha', 'Hasitha1234');
insert into Employee
values (5,'Sadun', 'Senarath', 'No235 , 2nd new lane,Nugegoda', '1998-11-10', 'Editor','ESsadun', 'Sadun1234');

insert into Administrator
values (1, 'Abishek', 'Perera', 'No08, st.thomas street, Kandy', '1990-11-01', 'Abishek_PA', 'Abishek_PA1234');
insert into Administrator
values (2, 'Dineth', 'Jayakodi', 'No12, Kings street, colombo', '1992-12-12', 'Dineth_JA', 'Dineth_JA1234');
insert into Administrator
values (3, 'Amal', 'Perera', ' No24,Pinthaliya road , Kadawatha', '1989-10-12', 'Amal_PA', 'Amal_PA1234');
insert into Administrator
values (4, 'Iraj', 'Liyanage', '234/D, Samarathunga road, Maharagama', '1988-11-29', 'Iraj_LA', 'Iraj_LA1234');
insert into Administrator
values (5, 'Jagath', 'Silva', '121/E, Eriyawetiya, Kelaniya', '1989-12-15', 'Jagath_SA', 'Jagath_SA1234');

insert into Administrator_mobile_number
values ('0763689506', 1);
insert into Administrator_mobile_number
values ('0775454155', 1);
insert into Administrator_mobile_number
values ('0718659451', 2);
insert into Administrator_mobile_number
values ('0704654142', 3);
insert into Administrator_mobile_number
values ('0706545454', 3);
insert into Administrator_mobile_number
values ('0775454554', 4);
insert into Administrator_mobile_number
values ('0716545434', 5);

insert into Administrator_email
values ('Abishekperera@gmail.com',1);
insert into Administrator_email
values ('Abishekperera2019@gmail.com',1);
insert into Administrator_email
values ('Dinethjayakodi@gmail.com',2);
insert into Administrator_email
values ('Amalperera@gmail.com',3);
insert into Administrator_email
values ('Irajliyanage@gmail.com',4);
insert into Administrator_email
values ('Irajliyanage2023@gmail.com', 4);
insert into Administrator_email
values ('Jagathdesilva@gmail.com', 5);

insert into Employee_mobile_number
values ('0702346161', 1);
insert into Employee_mobile_number
values ('0712346846', 2);
insert into Employee_mobile_number
values ('0702344545', 2);
insert into Employee_mobile_number
values ('0706481145', 3);
insert into Employee_mobile_number
values ('0775564242', 3);
insert into Employee_mobile_number
values ('0716554242', 4);
insert into Employee_mobile_number
values ('0716599534', 5);

insert into Employee_email 
values ('Ashenweerasinghe@gmail.com', 1);
insert into Employee_email 
values ('Subathwijesinghe@gmail.com', 2);
insert into Employee_email 
values ('Subathwijesinghe231@gmail.com', 2);
insert into Employee_email 
values ('Vajiraperera@gmail.com', 3);
insert into Employee_email 
values ('Hsithabandara@gmail.com', 4);
insert into Employee_email 
values ('Hasithabandara564@gmail.com', 4);
insert into Employee_email 
values ('Sadunsenarath12@gamil.com', 5);

insert into Client_mobile_number
values ('0719982506', 1);
insert into Client_mobile_number
values ('0716525241', 2);
insert into Client_mobile_number
values ('0775454334', 3);
insert into Client_mobile_number
values ('0777545432', 3);
insert into Client_mobile_number
values ('0704541551', 4);
insert into Client_mobile_number
values ('0715355312', 4);
insert into Client_mobile_number
values ('0775453544', 5);

insert into Client_email
values ('Yasmimunaweera@gmail.com',1);
insert into Client_email
values ('Chamathwijesinghe@gmail.com',2);
insert into Client_email
values ('Chamathwijesinghe546@gmail.com',2);
insert into Client_email
values ('Keshalsamarakkodi@gmail.com',3);
insert into Client_email
values ('Udaraudawatha@gmail.com',4);
insert into Client_email
values ('Sahanthilakathne@gmail.com', 5);

insert into Event_tb
values (1, 'Wedding', 'Capturing the magical moments from the grandest day of their lives is our favorite. We as photographers are well acquaint with our responsibility of capturing good shots while letting the couple cherish every moment so that they can go through their album over and over to see how elegant they looked in those enchanted moments.');
insert into Event_tb
values (2, 'Birthday', 'Finding innovative methods to celebrate their birthdays has become a great pleasure among people nowadays. Capturing their laughter, surprise in their faces, love, and care among each other is our responsibility as photographers since nothing can bring happiness and satisfaction than a well-planned birthday.');
insert into Event_tb
values (3, 'New-born', 'Capturing the natural actions of the baby and specially the joy and astonishment in the faces of family members is our intention as photographers. We feel capturing these blessed moments important since most parents often get ambiguous on memories at this stage.');
insert into Event_tb
values (4, 'Sports events', 'This genre encompasses all types of sports. We offer on-site action photography services to sporting events, where all the participants get the opportunity to be uniquely photographed which makes athletes happy! We specialize in covering all sports events from professional competitions and matches to amateur events.');
insert into Event_tb
values (5, 'Fashion', 'Fashion photography is a fine orchestration of the human body, raw emotions, clothing, or accessories, with lighting and all other aspects which give life to a fine photograph. Our vision pursues a clean aesthetic and a modern approach. We always ensure that our clients are delivered with the best services to represent their brands.');

insert into package
values (1, 'Package 1', '10000');
insert into package
values (2, 'Package 2', '15000');
insert into package
values (3, 'Package 3', '135000');
insert into package
values (4, 'Package 4', '200000');
insert into package
values (5, 'Package 5', '250000');

insert into Event_package
values (1, 1);
insert into Event_package
values (1, 2);
insert into Event_package
values (1, 3);
insert into Event_package
values (2, 2);
insert into Event_package
values (3, 3);
insert into Event_package
values (4, 4);
insert into Event_package
values (5, 5);

insert into Feature
values (1,'Hired Photographers: 2');
insert into Feature
values (2,'Hired Photographers: 4');
insert into Feature
values (3,'Hired Photographers: 6');
insert into Feature
values (4, 'Cameras: DSLR');
insert into Feature
values (5,'Gopro hero 8');
insert into Feature
values (6,'Gopro max (360 shots available)');
insert into Feature
values (7,'Photos(4k)');
insert into Feature
values (8,'Drone shot available');

insert into Package_feature
values (1, 1);
insert into Package_feature
values (1, 4);
insert into Package_feature
values (2, 2);
insert into Package_feature
values (2, 4);
insert into Package_feature
values (3, 3);
insert into Package_feature
values (3, 4);
insert into Package_feature
values (3, 5);
insert into Package_feature
values (4, 3);
insert into Package_feature
values (4, 4);
insert into Package_feature
values (4, 5);
insert into Package_feature
values (4, 6);
insert into Package_feature
values (4, 7);
insert into Package_feature
values (5, 3);
insert into Package_feature
values (5, 4);
insert into Package_feature
values (5, 5);
insert into Package_feature
values (5, 6);
insert into Package_feature
values (5, 7);
insert into Package_feature
values (5, 8);

insert into booking
values (1, 1, 1, 1, '2021-12-24', 'Completed', 'Completed');
insert into booking
values (2, 2, 2, 2, '2021-12-26', 'Completed', 'Completed');
insert into booking
values (3, 3, 3, 3, '2021-12-14', 'Completed', 'Completed');
insert into booking
values (4, 4, 4, 4, '2021-12-31', 'Completed', 'Completed');
insert into booking
values (5, 5, 5, 5, '2021-11-14', 'Completed', 'Completed');

insert into Album
values (1, 'Yashmi Kiribathgoda Album');
insert into Album
values (2, 'Chamath Kadawatha Album');
insert into Album
values (3, 'Keshal Mount Lavaniya Album');
insert into Album
values (4, 'Udara Thissamaharama Album');
insert into Album
values (5, 'Sahan thilakarathne Album');

insert into Booking_employee
values (1, 2);
insert into Booking_employee
values (1, 5);
insert into Booking_employee
values (1, 3);
insert into Booking_employee
values (2, 1);
insert into Booking_employee
values (2, 5);
insert into Booking_employee
values (2, 3);
insert into Booking_employee
values (3, 5);
insert into Booking_employee
values (3, 2);
insert into Booking_employee
values (3, 4);
insert into Booking_employee
values (4, 2);
insert into Booking_employee
values (4, 5);
insert into Booking_employee
values (4, 4);
insert into Booking_employee
values (5, 2);
insert into Booking_employee
values (5, 5);
insert into Booking_employee
values (5, 3);
