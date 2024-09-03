<?php
    session_start();
    include "./__Encrypt.php";

    $CookiesChecker = new Credential_Submitter();
    $Config = new Configer();

    $Cookie = isset($_COOKIE['sess_id']) ? $_COOKIE['sess_id'] : null;
    $Session_id = isset($_COOKIE['id']) ? $_COOKIE['id'] : null;

    if($Cookie != null)
    {
        $CookieSet = new DateTime($CookiesChecker->getCookie($Cookie));
    }

    if($Session_id !== null)
    {
        $User_data = $CookiesChecker->getData(substr($Session_id,-1));
    } 
?>

<?php if(isset($_COOKIE['id']) && isset($_COOKIE['sess_id']) && new DateTime() < $CookieSet) {?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tasks</title>
        <link rel="stylesheet" href="./Styles/__index.css">
    </head>
    <body>
        <div class="tasks-input" style="visibility: hidden;">
            <div class="task-heading">
                <img src="<?php echo $Config->getConfig('IMAGES_DIR')."close_ring_duotone.svg"; ?>" alt="close" id="input-close">
            </div>
            <div class="contents">
                <form action="./__Tasks.php" method="post" id="credentials">
                    <div class="inputs">
                        <label for="title-text">Task Name</label>
                        <input type="text" name="title-text" class="title-input" placeholder="Enter your task name" required>
                        <br>
                        <label for="">Description</label>
                        <textarea name="desc_text" id="tarea" placeholder="Enter a short description" required></textarea>
                    </div>
                
                    <label for="">Icons</label>
                    <div class="icon-tab">
                        <input type="radio" name="icons_select" value="1" id="work" checked>
                        <label for="work">
                            <img src="<?php echo $Config->getConfig('LOGOS_DIR')."briefcase-solid.svg"?>" alt="work">
                        </label>

                        <input type="radio" name="icons_select" value="2" id="chat">
                        <label for="chat">
                            <img src="<?php echo $Config->getConfig('LOGOS_DIR')."comment-regular.svg"?>" alt="chat">
                        </label>

                        <input type="radio" name="icons_select" value="3" id="break">
                        <label for="break">
                            <img src="<?php echo $Config->getConfig('LOGOS_DIR')."mug-hot-solid.svg"?>" alt="break">
                        </label>

                        <input type="radio" name="icons_select" value="4" id="gym">
                        <label for="gym">
                            <img src="<?php echo $Config->getConfig('LOGOS_DIR')."dumbbell-solid.svg"?>" alt="gym">
                        </label>

                        <input type="radio" name="icons_select" value="5" id="study">
                        <label for="study">
                            <img src="<?php echo $Config->getConfig('LOGOS_DIR')."book-solid.svg"?>" alt="study">
                        </label>

                        <input type="radio" name="icons_select" value="6" id="time">
                        <label for="time">
                            <img src="<?php echo $Config->getConfig('LOGOS_DIR')."clock-solid.svg"?>" alt="time">
                        </label>
                    </div>
                    <label for="">Status</label>
                    <div class="status-tab">
                        <input type="radio" name="status_select" value="s1" id="prog" checked>
                        <label for="prog">
                            <div class="prog-in">
                                <img src="<?php echo $Config->getConfig('IMAGES_DIR')."Time_atack_duotone.svg"; ?>" alt="progress" id="progress">
                                <p>In Progress</p>
                            </div>
                        </label>

                        <input type="radio" name="status_select" value="s2" id="complete">
                        <label for="complete">
                            <div class="comp">
                                <img src="<?php echo $Config->getConfig('IMAGES_DIR')."Done_round_duotone.svg"; ?>" alt="completed" id="compimg">
                                <p>Completed</p>
                            </div>
                        </label>

                        <input type="radio" id="wont" value="s3" name="status_select">
                        <label for="wont">
                            <div class="wontdiv">
                                <img src="<?php echo $Config->getConfig('IMAGES_DIR')."close_ring_duotone.svg"; ?>" alt="cloes" id="wontimg">
                                <p>Won't do</p>
                            </div>
                        </label>
                    </div>
                    <input type="hidden" name="newData">
                </form>
            </div>
            <input type="submit" value="submit" id="form-button">
        </div>

        <div class="tasks-edit" style="visibility: hidden;">
            <div class="task-heading">
                <img src="<?php echo $Config->getConfig('IMAGES_DIR')."close_ring_duotone.svg"; ?>" alt="close" id="editinput-close">
            </div>
            <div class="contents">
                <form action="./__Tasks.php" method="post" id="credentialsedit">
                    <div class="inputs">
                        <label for="title-text">Task Name</label>
                        <input type="text" name="title-text" class="title-input" placeholder="Enter your task name" id="task_title">
                        <br>
                        <label for="">Description</label>
                        <textarea name="desc_text" id="tareaedit" placeholder="Enter a short description" required></textarea>
                    </div>
                
                    <label for="">Icons</label>
                    <div class="icon-tab">
                        <input type="radio" name="icons_select" value="1" id="workedit" checked>
                        <label for="workedit">
                            <img src="<?php echo $Config->getConfig('LOGOS_DIR')."briefcase-solid.svg"?>" alt="work">
                        </label>

                        <input type="radio" name="icons_select" value="2" id="chatedit">
                        <label for="chatedit">
                            <img src="<?php echo $Config->getConfig('LOGOS_DIR')."comment-regular.svg"?>" alt="chat">
                        </label>

                        <input type="radio" name="icons_select" value="3" id="breakedit">
                        <label for="breakedit">
                            <img src="<?php echo $Config->getConfig('LOGOS_DIR')."mug-hot-solid.svg"?>" alt="break">
                        </label>

                        <input type="radio" name="icons_select" value="4" id="gymedit">
                        <label for="gymedit">
                            <img src="<?php echo $Config->getConfig('LOGOS_DIR')."dumbbell-solid.svg"?>" alt="gym">
                        </label>

                        <input type="radio" name="icons_select" value="5" id="studyedit">
                        <label for="studyedit">
                            <img src="<?php echo $Config->getConfig('LOGOS_DIR')."book-solid.svg"?>" alt="study">
                        </label>

                        <input type="radio" name="icons_select" value="6" id="timeedit">
                        <label for="timeedit">
                            <img src="<?php echo $Config->getConfig('LOGOS_DIR')."clock-solid.svg"?>" alt="time">
                        </label>
                    </div>
                    <label for="">Status</label>
                    <div class="status-tab">
                        <input type="radio" name="status_select" value="s1" id="progedit" checked>
                        <label for="progedit">
                            <div class="prog-in">
                                <img src="<?php echo $Config->getConfig('IMAGES_DIR')."Time_atack_duotone.svg"; ?>" alt="progress" id="progress">
                                <p>In Progress</p>
                            </div>
                        </label>

                        <input type="radio" name="status_select" value="s2" id="completeedit">
                        <label for="completeedit">
                            <div class="comp">
                                <img src="<?php echo $Config->getConfig('IMAGES_DIR')."Done_round_duotone.svg"; ?>" alt="completed" id="compimg">
                                <p>Completed</p>
                            </div>
                        </label>

                        <input type="radio" id="wontedit" value="s3" name="status_select">
                        <label for="wontedit">
                            <div class="wontdiv">
                                <img src="<?php echo $Config->getConfig('IMAGES_DIR')."close_ring_duotone.svg"; ?>" alt="cloes" id="wontimg">
                                <p>Won't do</p>
                            </div>
                        </label>
                    </div>
                    <input type="hidden" name="editData" value="" class="edithidden">
                </form>
            </div>
            <div class="edit-submit">
                <input type="submit" value="Edit" id="edit-button" name="edit_content">
                <input type="submit" value="Delete" id="delete-button" name="delete_content">
            </div>
        </div>

        <div class="container">

            <div class="heading">
                <img src="<?php echo $Config->getConfig('IMAGES_DIR')."Logo.svg"; ?>" alt="Logo">
                <h2>My Task Board</h2>
                <img src="<?php echo $Config->getConfig('IMAGES_DIR')."Edit_duotone.svg"; ?>" alt="Edit">
            </div>

            <h4 class="tasks">Taks to keep organized</h4>

            <br>

            <div class="tasks-container">
                <?php if(count($User_data) == 0) {?>
                    <p>No tasks yet.</p>
                <?php } else { ?>
                    <?php for($i=0;$i<count($User_data);$i++) {?>
                        <div class="task1" style="background-color: <?php echo $User_data[$i]['status']?>;" id="<?php echo $User_data[$i]['tasks_id'];?>">
                            <img src="<?php echo $Config->getConfig('LOGOS_DIR').$User_data[$i]['icon'] ;?>" alt="tasks">
                            <div class="task-contents">
                                <p class="headingpara"><?php echo $User_data[$i]['task'];?></p>
                                <div class="para-heading">
                                    <p class="descpara"><?php echo $User_data[$i]['description']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>

            <div class="add-task" id="add-task-button">
                <img src="<?php echo $Config->getConfig('IMAGES_DIR')."Add_round_duotone.svg"?>" alt="Add" style="background-color: #e9a23b;">
                <p class="ap" style="font-weight: 700;">Add new task</p>        
            </div>

        </div>
    </body>
    <script>
        let form = document.getElementById("credentials");
        let submit_button = document.getElementById("form-button");
        let Close_button = document.getElementById("input-close");
        let Add_task_button = document.getElementById("add-task-button");
        let task_input_form = document.querySelector(".tasks-input");
        let task_edit_form = document.querySelector(".tasks-edit");
        let edit_div = document.querySelectorAll(".task1");
        let edit_form_id = document.querySelector(".edithidden");
        let edit_form_close = document.getElementById("editinput-close");
        let edit_form_title = document.getElementById("task_title");
        let edit_form_desc = document.getElementById("tareaedit");
        let edit_button = document.getElementById("edit-button");
        let edit_delete_button = document.getElementById("delete-button");
        let edit_form = document.getElementById('credentialsedit');


        submit_button.addEventListener('click',() => {
            form.submit();
        })

        Add_task_button.addEventListener('click',() => {
            task_input_form.style.visibility = "visible";
        });

        Close_button.addEventListener('click',() => {
            task_input_form.style.visibility = "hidden";
        });

        edit_div.forEach((elem) => {
           elem.addEventListener('click',() => {
                task_edit_form.style.visibility = "visible";
                edit_form_id.value = elem.id;
                edit_form_desc.value = elem.querySelector(".descpara").innerHTML;
                edit_form_title.value = elem.querySelector(".headingpara").innerHTML;
           }) 
        });

        edit_form_close.addEventListener('click',() => {
            task_edit_form.style.visibility = "hidden";
        })

        edit_button.addEventListener('click',() => {
            var hidden = document.createElement("input");
            hidden.type = "hidden";
            hidden.name = "edits";
            document.getElementById("credentialsedit").appendChild(hidden);
            edit_form.submit(); 
        });

        edit_delete_button.addEventListener('click',() => {
            var delete_in = document.createElement("input");
            delete_in.type = "hidden";
            delete_in.name = "delete_edit";
            document.getElementById("credentialsedit").appendChild(delete_in);
            edit_form.submit();
        })

    </script>
    </html>
<?php } else {?>
    <?php header("Location: ./__Login.php"); ?>
<?php } ?>
