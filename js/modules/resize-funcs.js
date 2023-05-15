
    /*----------------------------------------------------------------------------*/
    /* --------------------------   Resize Functions   ---------------------------*/
    /*----------------------------------------------------------------------------*/

    var reinitTimer;
    $(window).resize(function() {
        clearTimeout(reinitTimer);

        /*Quicker - For Light Functions*/
        //reinitTimer = setTimeout(sticky_elements_function, 10);

        /*Slower - For Heavy Functions*/
        //reinitTimer = setTimeout(mobile_function, 100);


        /* ----------------------   TMP Resize Functions   ---------------------------*/
        /*----------------------------------------------------------------------------*/

        // reinitTimer = setTimeout(last_first_class_function('#footer ul','li'), 100);

    });