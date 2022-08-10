Sales And Inventory Management System
=====================================

*   [Introduction](#introduction)
*   [Features](#features)
*   [Prerequisites](#prerequisites)
*   [Installation](#installation)
*   [Setup](#setup)
*   [Usage](#usage)

Introduction
============

Sales and Inventory management system aims to serve customer effortlessely and manage inventory efficiently. This system will help the staff/employees to have a faster way of recording details of each transation and improve the manual system of monitoring inventory. The system will provide a good service to the company like better transaction process that brings bigger profit.

Technology Stack

*   Laravel
*   Bootstrap

Features
========

This sales and inventory management system is loaded with following features:

*   Smart Dashboard for Sales and Inventory Overview
*   Solid Authentication and Role based access control
*   Powerfull Search option
*   Easily Add, Edit, Remove item from inventory + Manage item Quantity
*   Create bill with automated stock management
*   Add, Edit, Remove Vendor + Manage their Bills
*   Record Customer transaction effortlessely

Prerequisites
=============

You will need following dependecies installed in your system

*   PHP
*   DBMS - phpmyadmin or any
*   Composer

Installation
============

Step 1: Open the following github repository https://github.com/yashkumat/laravel-inventory.git

Step 2: Download the repository and Open the folder in code editor of your choice

Step 3: Rename .env.example to just .env

Step 4: Change APP\_NAME and Database settings in .env file

`DB_CONNECTION=mysql   DB_HOST=127.0.0.1   DB_PORT=3306   DB_DATABASE=your_database_name   DB_USERNAME=your_database_system_username   DB_PASSWORD=your_database_system_password   `

Step 5: Run following command in command prompt or terminal in root directory

`php artisan key:generate`  
`php artisan migrate`  
`php artisan serve`

Step 6: Go to link localhost:8000

Setup
=====

Welcome screen will show APP\_NAME and login link

First we will have to create admin which can then can create other profiles with different access control

Run following command in command prompt or terminal in root directory

`$user = new App\Models\User();   $user->password = Hash::make('Admin@'2022);   $user->email = 'admin@store-name.com';   $user->name = 'Admin';   $user->isAdmin = '1';   $user->save();`

Usage
=====

### Dashboard

*   Overview of total sale, total profit, total purchase, total customers, Low quantity items total debt, total credit, etc

### Authentication and Access Control

*   Only Admin get full details about product like its cost price, expense per unit, etc
*   Only Admin can create staff account which has only required limited access
*   User screen shows only store details
*   Login / Logout with session management

### Inventory

*   Add, Edit, Hide item
*   Manage quantity with vendors bill
*   Add item to bill
*   Highlight low quantity items

### Vendor

*   Manage vendors and their bills

### Bill

*   Make bill with discount
*   On page search feature
*   Add mode of payment, GST number, etc
*   Save bill with pending status and amount.

### User Management

*   Make user
*   Assign admin status to any user
*   Activate/Deactivate any user
