<?php
enum  NotificationTypes
{
   case info;
   case product;
   case import;
   case order;
   case error;
   case alert;
}
enum ErrorType
{
   case connection;
   case connection_aborted;
}
enum LogTypes
{
   case error;
   case cron;
   case email;
   case file;
}
enum EntityType
{
   case product;
   case category;
   case psychotropic;
   case brand;
}
enum responseType
{
   case error;
   case success;
   case info;
   case warming;
}
// abstract class NotificationTypes
// {
//    const Information = 'INFO';
//    const Products = 'PRODUCTS';
//    const Imports = 'IMPORTS';
//    const Orders = 'ORDERS';
//    const Errors = 'ERRORS';
//    const Alerts = 'ALERTS';
// }
// abstract class ErrorTypes
// {
//    const ConnectionError = 'CONNECTION';
//    const DatabaseError = 'DATABASE';
//    const FrontError = 'FRONT';
//    const RequestError = 'REQUEST';
//    const ResponseError = 'RESPONSE';
// }
// abstract class LogTypes
// {
//    const Error = 'ERROR';
//    const Cron = 'CRON';
// }

// abstract class MessageTypes
// {
//    const Error = 'danger';
//    const Success = 'success';
//    const Warning = 'warning';
//    const Info = 'info';
// }
// abstract class ControllerType
// {
//    const Front = 0;
//    const Admin = 1;
//    const Modules = 2;
// }
// abstract class UsersGroup
// {
//    const SuperSu = 'S';
//    const Developer = 'D';
//    const Admin = 'A';
//    const Clients = 'C';
// }
// abstract class UserType
// {
//    const SuperSu = -1;
//    const Developer = 0;
//    const Admins = 1;
//    const Suppliers = 2;
//    const Clients = 3;
// }
