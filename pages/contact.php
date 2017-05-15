<style>
    .map-container {
        position: relative;
        height: 0;
        overflow: hidden;
        /* 4x3 Aspect Ratio */
        padding-bottom: 75%;
    }


    .map-container iframe {
        position: absolute;
        top:0;
        left: 0;
        width: 100%;
        height: 100%;
    }

</style>


<div class="panel panel-success">
    <div class="panel-heading"><h4>Kontaktinformasjon</h4></div>
    <div class="panel-body">
        <p class="lead float-left">Vi er her for å besvare dine spørsmål.<br>
            Vennligst fyll inn skjemaet under, eller kontakt oss på telefonnummer oppgitt til høyre.</p>


    <div class="contact-and-map-box float-right">
        <ul class="list-group">
            <li class="list-group-item">Stig | Utvikler<span class="badge">Tlf.: 12 34 56 78</span></li>
            <li class="list-group-item">André | Utvikler<span class="badge">Tlf.: 12 34 56 78</span></li>
            <li class="list-group-item">Nichlas | Innvikler <span class="badge">Tlf.: 12 34 56 78</span></li>
        </ul>
    </div>
    <div class="clear"></div>
    <div class="contact-and-map-box float-right">
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7887.517442401701!2d5.321381824224714!3d60.38115272672769!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x463cf954bfda0863%3A0x6f5174eb42ffc36f!2sThorm%C3%B8hlens+Gate+49%2C+5006+Bergen!5e0!3m2!1sen!2sno!4v1494520266070&key=AIzaSyA2DrBaGZmfJxrp3yNt6Twcce03r81Tdsw"
                    frameborder="0" style="border: 0;"></iframe>
        </div>
    </div>

    <div id="form-box">
        <legend>Kontakt oss her</legend>
        <form class="form-horizontal" action="">
            <div class="form-group">
                <label class="control-label col-sm-2" for="name">Navn:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Navn" name="name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">E-post:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" placeholder="E-post" name="email">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="subject">Emne:</label>
                <div class="col-sm-10">
                <select class="form-control" id="subject">
                    <option>Forslag</option>
                    <option>Siden er nede</option>
                    <option>Annet</option>
                </select>
                    </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="content">Skriv her:</label>
                <div class="col-sm-10">
                <textarea class="form-control" rows="5" id="content" style="max-width: 100%;"></textarea>
                    </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
        </form>
    </div>



        <div class="clear"></div>
        <!-- API-KEY    AIzaSyA2DrBaGZmfJxrp3yNt6Twcce03r81Tdsw -->





    </div>

</div>

