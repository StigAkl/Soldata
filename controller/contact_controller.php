<?php
/**
 * Created by PhpStorm.
 * User: EliseIGank
 * Date: 15.05.2017
 * Time: 14.02
 */

ini_set("display_errors", 0);
//Initialiser emnevalg
$subjects = array("Forslag", "Siden er nede", "Annet");

$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : "";
//Variabel for feilmelding. Blir initialisert hvis det oppstår en feil
$errors = $_SESSION["errors"];
//Variabel for gyldige inputs, slik at bruker slipper å skrive inn gyldige inputs igjen.
$inputs = $_SESSION['inputs'];

//Initialiserer feilmeldingene som skal bli skrevet ut. Dersom de ikke eksisterer, vil de bli blank og ingenting vil bli skrevet ut
if(is_array($errors)) {
    $nameerror      = $errors['nameerror'];
    $emailerror     = $errors['emailerror'];
    $subjecterror   = $errors['subjecterror'];
    $messageerror   = $errors['messageerror'];
} else {
    $nameerror      = "";
    $emailerror     = "";
    $subjecterror   = "";
    $messageerror   = "";
}

//Initialiserer brukerinputs fra session, slik at dersom gyldig input ble oppgitt skal de ikke skrives inn igjen
if(is_array($inputs)) {
    $nameinput      = $inputs['name'];
    $emailinput     = $inputs['email'];
    $subjectinput   = $inputs['subject'];
    $messageinput   = $inputs['message'];
} else {
    $nameinput      = "";
    $emailinput     = "";
    $subjectinput   = "";
    $messageinput   = "";
}


//Noen konstanter for validering
$NAME_REGEX         = "/^[a-zA-Z ]*$/";
$SUBJECT_REGEX      = "/^[a-z0-9 .\-\,]+$/i";
$NAME_MAX_LENGTH    = 100;
$EMAIL_MAX_LENGTH   = 50;
$SUBJECT_MAX_LENGTH = 50;

//Valider inputs
if(isset($_POST['submit_ticket'])) {

    //Lagrer variablene fra POST-forespørselen
    $name       = htmlspecialchars($_POST['name']);
    $email      = htmlspecialchars($_POST['email']);
    $subject    = htmlspecialchars($_POST['subject']);
    $message    = htmlspecialchars($_POST['message']);

    //Initialiserer inputfelt-verdiene før validering.
    $nameinput      = $name;
    $emailinput     = $email;
    $subjectinput   = $subject;
    $messageinput   = $message;


    //Validering av name, setter nameinput til blankt dersom feil.
    if(!preg_match($NAME_REGEX,$name) || strlen($name) > $NAME_MAX_LENGTH) {
        $nameerror = "Navn kan kun inneholde bokstaver a-z / A-Z og ikke være lenger enn " . $NAME_MAX_LENGTH . " tegn";
        $nameinput = "";
    } else if(empty($name)) {
        $nameerror  = "Du må oppgi navn.";
        $nameinput  = "";
    }


    //validering av subject, setter subjectinput til blankt dersom feil
    if(empty($subject) || strlen($subject) > $SUBJECT_MAX_LENGTH || !preg_match($SUBJECT_REGEX, $subject)) {
        $subjecterror   = "Ugyldig emne.";
        $subjectinput   = "";
    }


    //Validering av epost, setter emailinput til blankt dersom feil
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailerror  = "Du må oppgi inn en gyldig epost";
        $emailinput  = "";
    } else if(strlen($email) > $EMAIL_MAX_LENGTH) {
        $emailerror = "Eposten kan ikke være lenger enn " . $EMAIL_MAX_LENGTH . " tegn";
        $emailinput = "";
    }

    //Validering av meldingen
    if(empty($message)) {
        $messageerror   = "Bare bokstaver, tall og følgende tegn er lovlig: . / -";
    }


    //Dersom ingen feil, skal informasjonen lagres i databasen og vi gjør en redirect
    if(empty($nameerror) && empty($emailerror) && empty($subjecterror) && empty($messageerror)) {
        $success = "Takk for at du tok kontakt med oss! Vi vil besvare din henvendelse så raskt som mulig!";
        $_SESSION['success_message']    = $success;
        header("Location: index.php?page=contact&success");
        exit();
    } else {
        $errors = array("nameerror" => $nameerror, "emailerror" => $emailerror, "subjecterror" => $subjecterror, "messageerror" => $messageerror);
        $inputs = array("name" => $nameinput, "email" => $emailinput, "subject" => $subjectinput, "message" => $messageinput);
        $_SESSION["errors"] = $errors;
        $_SESSION["inputs"] = $inputs;
        header("Location: index.php?page=contact&error");
        exit();
    }
}



//Funksjoner for å skrive ut korrekt form basert på validering.
//Navn-form
function name_form($nameerror, $nameinput) {

    //Ugyldig navn
    if(!empty($nameerror)) {
        $form = <<<_END
            <div class="col-sm-9">
                    <div class="form-group has-error has-feedback">
                    <input type="text" value="$nameinput"class="form-control" name="name" placeholder="Navn" name="name">
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                    </div>
                </div> 
_END;
    }

    //Gyldig navn
    else if(!empty($nameinput) && empty($nameerror)) {
        $form = <<<_END
            <div class="col-sm-9">
                    <div class="form-group has-success has-feedback">
                    <input type="text" value="$nameinput"class="form-control" name="name" placeholder="Navn" name="name">
                    <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                    </div>
                </div>
_END;
    }
    //Brukeren har ikke skrevet inn noe, vanlig form.
    else {
        $form = <<<_END
            <div class="col-sm-9">
                <div class="form-group">
                    <input type="text" value="$nameinput"class="form-control" name="name" placeholder="Navn">
                </div>
             </div>
_END;
    }

    return $form;
}


//Epost-form
function email_form($emailerror, $emailinput) {

    //Ugyldig epost
    if(!empty($emailerror)) {
        $form = <<<_END
            <div class="col-sm-9">
                    <div class="form-group has-error has-feedback">
                    <input type="text" value="$emailinput"class="form-control" name="email" placeholder="Epost">
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                    </div>
                </div> 
_END;
    }

    //Gyldig epost
    else if(!empty($emailinput) && empty($emailerror)) {
        $form = <<<_END
            <div class="col-sm-9">
                    <div class="form-group has-success has-feedback">
                     <input type="text" value="$emailinput"class="form-control" name="email" placeholder="Epost">
                    <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                    </div>
                </div>
_END;
    }
    //Brukeren har ikke skrevet inn noe, vanlig form.
    else {
        $form = <<<_END
            <div class="col-sm-9">
                <div class="form-group">
                     <input type="text" value="$emailinput"class="form-control" name="email" placeholder="Epost">
                </div>
             </div>
_END;
    }
    return $form;
}


//Melding-form
function message_form($messageerror, $messageinput) {

    //Tom melding
    if(!empty($messageerror)) {
        $form = <<<_END
            <div class="col-sm-9">
                    <div class="form-group has-error has-feedback">
                    <textarea class="form-control" value="$messageinput"rows="5" name="message" id="content" style="max-width: 100%;">$messageinput</textarea>
                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                    </div>
                </div> 
_END;
    }

    //Gyldig melding
    else if(!empty($messageinput) && empty($messageerror)) {
        $form = <<<_END
            <div class="col-sm-9">
                    <div class="form-group has-success has-feedback">
                     <textarea class="form-control" value="$messageinput"rows="5" name="message" id="content" style="max-width: 100%;">$messageinput</textarea>
                    <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                    </div>
                </div>
_END;
    }
    //Brukeren har ikke skrevet inn noe, vanlig form.
    else {
        $form = <<<_END
            <div class="col-sm-9">
                <div class="form-group">
                      <textarea class="form-control" value="$messageinput"rows="5" name="message" id="content" style="max-width: 100%;">$messageinput</textarea>
                </div>
             </div>
_END;
    }
    return $form;
}

?>