<head>
    <style>
        @import url('/CSS/register.css');
    </style>
</head>
<body>
    <form title="Register" method="post" action="#">
        <legend title="Create">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path data-v-20f285ec="" d="M19 12H5m7 7-7-7 7-7"/>
            </svg>
            <h2>Create Account</h2>
        </legend>
        <span class="inputBox">
            <input name="username" type="text" required="required"
            <?php
                if(isset($_POST['username'])) {
                    $username = trim($_POST['username']);
                    if(!ctype_alnum($username)) {
                        echo "class='invalid'";
                    }
                    echo 'value="'.$username.'"'." class='valid'"; 
                }
                else if(isset($_POST['submit'])) {
                    echo "class='invalid'";
                }
            ?>
            />
            <span title="required_span">
                <legend>Username</legend>
                <legend class="required">Obligatoire</legend>
            </span>
        </span>
        <span class="inputBox unrequired">
            <input name="mail" type="text" placeholder=" " pattern="[a-z0-9._%+-]+@[a-z0-9._-]+\.[a-z]{2,4}$"
            <?php
                if(isset($_POST['submit'])) {
                    if(isset($_POST['mail'])) {
                        $mail = trim($_POST['mail']);
                        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                            echo "class='invalid'";
                        }
                        echo 'value="'.$mail.'"'." class='valid'"; 
                    }
                }
            ?>
            />
            <span>
                <legend>Email</legend>
            </span>
        </span>
        <span class="inputBox">
            <input name="password" type="text" required="required"
            <?php
                if(isset($_POST['password'])) {
                    $password = trim($_POST['password']);
                    if(!ctype_alnum($password)) {
                        echo "class='invalid'";
                    }
                    echo 'value="'.$password.'"'." class='valid'"; 
                }
                else if(isset($_POST['submit'])) {
                    echo "class='invalid'";
                }
            ?>
            />
            <span title="required_span">
                <legend>Password</legend>
                <legend class="required">Obligatoire</legend>
            </span>
        </span>
        <span class="inputBox unrequired">
            <input name="name" type="text" placeholder=" "
            <?php
                if(isset($_POST['name'])) {
                    $name = trim($_POST['name']);
                    if(!ctype_alpha($name)) {
                        echo "class='invalid'";
                    }
                    echo 'value="'.$name.'"'." class='valid'"; 
                }
                else if(isset($_POST['submit'])) {
                    echo "class='invalid'";
                }
            ?>
            />
            <span>
                <legend>Name</legend>
            </span>
        </span>
        <span class="inputBox unrequired">
            <input name="first_name" type="text" placeholder=" "
            <?php
                if(isset($_POST['first_name'])) {
                    $first_name = trim($_POST['first_name']);
                    if(!ctype_alpha($first_name)) {
                        echo "class='invalid'";
                    }
                    echo 'value="'.$first_name.'"'." class='valid'"; 
                }
                else if(isset($_POST['submit'])) {
                    echo "class='invalid'";
                }
            ?>
            />
            <span>
                <legend>First Name</legend>
            </span>
        </span>
        <input name="date" type="date"
        <?php 
            if(isset($_POST['submit'])) {
                if(isset($_POST['date'])) {
                    $date = $_POST['date'];
                    echo 'value="'.$_POST['date'].'"';
                    if($date != "") {
                        list($year,$month,$day)=explode('-',$date);
                        if(checkdate($month,$day,$year)) echo ' class="valid"';
                        else echo ' class="invalid"';
                    }
                }
            }
        ?>
        />
        <span title="Gender_Field"
        <?php
            if(isset($_POST['submit'])) {
                if(isset($_POST['sex'])) {
                    $sex = $_POST['sex'];
                    if(($sex == 'h') || ($sex == 'f') || ($sex == 'o')) {
                      echo "class='valid'";
                    }
                }
            }
        ?>
        >
            <div>
                <input value="h" type="radio" name="sex"
                <?php
                    if(isset($_POST['submit'])) {
                        if(isset($_POST['sex'])) {
                            $sex = $_POST['sex'];
                            if($sex == 'h') {
                              echo "checked='checked'";
                            }
                        }
                    }
                ?>
                />
                <svg class="Radio_Checked" viewBox="0 0 24 24" fill="none">
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="m9 11 3 3L22 4" stroke="#FF6740" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg class="Radio" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" fill="transparent" rx="2" ry="2"/>
                </svg>
                <label>Man</label>
            </div>
            <div>
                <input value="f" type="radio" name="sex"
                <?php
                    if(isset($_POST['submit'])) {
                        if(isset($_POST['sex'])) {
                            $sex = $_POST['sex'];
                            if($sex == 'f') {
                              echo "checked='checked'";
                            }
                        }
                    }
                ?>
                />
                <svg class="Radio_Checked" viewBox="0 0 24 24" fill="none">
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="m9 11 3 3L22 4" stroke="#FF6740" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg class="Radio" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" fill="transparent" rx="2" ry="2"/>
                </svg>
                <label>Woman</label>
            </div>
            <div>
                <input value="o" type="radio" name="sex"
                <?php
                    if(isset($_POST['submit'])) {
                        if(isset($_POST['sex'])) {
                            $sex = $_POST['sex'];
                            if($sex == 'o') {
                              echo "checked='checked'";
                            }
                        }
                    }
                ?>
                />
                <svg class="Radio_Checked" viewBox="0 0 24 24" fill="none">
                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="m9 11 3 3L22 4" stroke="#FF6740" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg class="Radio" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" fill="transparent" rx="2" ry="2"/>
                </svg>
                <label>Other</label>
            </div>
        </span>
        <input title="Submit" type="submit" name="submit"/>
        <button>Log In Instead</button>
    </form>
    <?php 
        if(isset($_POST['submit'])) {
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/PHP/error.php";
            include_once($path);
        }
    ?>
</body>