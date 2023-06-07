<?php

namespace App\Services\Chatbot;

class Constants
{
    //registration
    const INIT = 1;
    const ABOUT_US = 2;
    const REGISTERED_USER_START_QUESTION_ID = 3;

    //open AI constant
    const OPEN_AI_CHAT = 4; // level one menu

    //Appointments
    const APPOINTMENTS = 5; // level one menu
    const APPOINTMENT_TYPE = 6; //level two menu
    const APPOINTMENT_DATE = 7; // level three menu //review or change of spectacles
    const APPOINTMENT_TIME = 8; // level three menu
    const APPOINTMENT_DETAIL_ASK = 9; // level three menu
    const APPOINTMENT_NOTE = 10; // level three menu
    const APPOINTMENT_BOOKING_DONE = 200; // completed booking of appointment


    const PREVIOUS_APPOINTMENT = 11; // level three menu - this is for any other thing client wants to show.. images can be included

    const FUTURE_APPOINTMENT = 12; //level two menu


    // const FUTURE_APPOINTMENT = 12; //level two menu
    // const
    //get date, get time, any additional note
    //Medical Records

    const MEDICAL_RECORDS = 1000; //level one menu

    const HELP = 2000; //level one menu

    //Help





    // const INIT = 1;


    const CHOOSE_FROM_AVAILABLE_OPTIONS = 800;
    const DONE = 900;
}
