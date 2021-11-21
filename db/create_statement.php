<?php
include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/db_connector.php";
include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/create_table.php";
// include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/create_procedure.php";
include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/create_trigger.php";
// include $_SERVER['DOCUMENT_ROOT'] . "/solid/db/drop_procedure_scheduler.php";

create_table($con, "members");
create_table($con, "deleted_members");
create_table($con, "notice");
create_table($con, "review");
create_table($con, "interest");
create_table($con, "faq");
create_table($con, "faq_ripple");
create_table($con, "free");
create_table($con, "free_ripple");
create_table($con, "question");
create_table($con, "question_ripple");
create_table($con, "coin_info");

//create_procedure($con, 'members_procedure');
//create_procedure($con, 'appointment_procedure');
//create_procedure($con, 'media_procedure');
//create_procedure($con, 'notice_procedure');
//create_procedure($con, 'faq_procedure');
//create_procedure($con, 'question_procedure');
//create_procedure($con, 'free_procedure');
//create_procedure($con, 'health_info_procedure');
// create_procedure($con, 'health_info_procedure1');

create_trigger($con, 'deleted_members');
// drop_procedure_scheduler($con);
?>