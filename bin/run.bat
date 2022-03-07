timeout 1 & cls & cd C:\xampp\htdocs\xhe\test & php accountTaskListPreparationTest.php 1000

/* LOCAL */
timeout 1 & cls & cd C:\xampp\htdocs\xhe\test & php insertCalendarEventListTest.php test:test 127.0.0.1 7667 --dynamical
timeout 7 & cls & cd C:\xampp\htdocs\xhe\test & php insertCalendarEventListTest.php test:test 127.0.0.1 7669 --dynamical
timeout 10 & cls & cd C:\xampp\htdocs\xhe\test & php insertCalendarEventListTest.php test:test 127.0.0.1 7671 --dynamical
timeout 13 & cls & cd C:\xampp\htdocs\xhe\test & php insertCalendarEventListTest.php test:test 127.0.0.1 7673 --dynamical
timeout 15 & cls & cd C:\xampp\htdocs\xhe\test & php insertCalendarEventListTest.php test:test 127.0.0.1 7675 --dynamical
timeout 17 & cls & cd C:\xampp\htdocs\xhe\test & php insertCalendarEventListTest.php test:test 127.0.0.1 7677 --dynamical

/* REMOTE 5.45.71.226 - OK */
timeout 1 & cls & cd C:\xampp\htdocs\xhe\test & php insertCalendarEventListRemoteTest.php test:test 5.45.71.226 7011 --dynamical
timeout 3 & cls & cd C:\xampp\htdocs\xhe\test & php insertCalendarEventListRemoteTest.php test:test 5.45.71.226 7013 --dynamical
timeout 5 & cls & cd C:\xampp\htdocs\xhe\test & php insertCalendarEventListRemoteTest.php test:test 5.45.71.226 7017 --dynamical

/* REMOTE 5.61.49.88 - OK */
timeout 1 & cls & cd C:\xampp\htdocs\xhe\test & php insertCalendarEventListRemoteTest.php test:test 5.61.49.88 7010 --dynamical
timeout 7 & cls & cd C:\xampp\htdocs\xhe\test & php insertCalendarEventListRemoteTest.php test:test 5.61.49.88 7015 --dynamical
timeout 11 & cls & cd C:\xampp\htdocs\xhe\test & php insertCalendarEventListRemoteTest.php test:test 5.61.49.88 7019 --dynamical

/* REMOTE 5.45.75.70 - OK */
timeout 1 & cls & cd C:\xampp\htdocs\xhe\test & php insertCalendarEventListRemoteTest.php test:test 5.45.75.70 7021 --dynamical
timeout 7 & cls & cd C:\xampp\htdocs\xhe\test & php insertCalendarEventListRemoteTest.php test:test 5.45.75.70 7025 --dynamical
timeout 11 & cls & cd C:\xampp\htdocs\xhe\test & php insertCalendarEventListRemoteTest.php test:test 5.45.75.70 7027 --dynamical

/* REMOTE 