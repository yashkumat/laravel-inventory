   Technical Documentation Page \*{ margin: 0; padding: 0; box-sizing: border-box; } #navbar{ position: fixed; width: 300px; top: 0; left: 0; background-color: rgb(220,220,220, 0.5); height: 100%; display: flex; flex-direction: column; justify-content: center; } @media (min-width: 600px) { #main-doc{ position: relative; width: calc(100% - 400px); margin: 2em; left: 300px; } #navbar li{ list-style: none; padding: 1em; border: 1px solid black; } #navbar ul{ margin-top: 4em; } #navbar a{ text-decoration: none; color: rgb(30, 30, 30); } #navbar h1{ font-size: 2em; } .main-section{ padding: 2em; line-height: 2em; font-size: 1em; } .main-section p{ text-align: justify; } .main-section code{ background-color: rgb(220,220,220, 0.5); padding: 0.5em; } .main-section ul{ margin-left: 2em; padding: 1em; } .main-section h1{ margin-bottom: 1em; font-size: 2em; } } @media (max-width: 600px) { #navbar{ position: relative; background-color: rgb(220,220,220, 0.5); width: 100%; } #navbar h1{ text-align:center; margin-bottom: 1em; font-size: 2em; } #navbar ul{ text-align: center; } #navbar li{ list-style: none; padding: 0.5em; border: 1px solid black; } #navbar a{ text-decoration: none; color: rgb(30, 30, 30); } #main-doc{ line-height: 1.5em; margin: 1em; } #main-doc h1{ font-size: 2em; padding: 1em; } #main-doc ul{ padding: 1em; } #main-doc code{ background-color: rgb(220,220,220, 0.5); word-wrap:break-word; } #main-doc p{ text-align: justify; } }

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
