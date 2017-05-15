<?php


if (isset($_GET['reply'])) {
    $id = htmlspecialchars($_GET['reply']);
    $ticket = get_ticket($id);
    ?>

    <div class="panel panel-success" id="graphs">
        <div class="panel-heading"><h4>Velkommen til Soldata! <img src="imgs/sun.png" width="25px" height="25px"/></h4>
        </div>
        <div class="panel-body">

            <fieldset>
                <legend>Henvendelse av <?php echo $ticket['name']; ?></legend>

                <div class="henvendelse">
                    <div class="form-group">
                        <label>Henvendelse:</label>
                        <p><?php echo nl2br($ticket['message']); ?></p>
                    </div>
                    </p>
                </div>
                <p><a href="index.php?page=admin_support_tickets">Tilbake</a></p>
            </fieldset>
        </div>
    </div>

    <?php
} else {
    ?>
    <div class="panel panel-success" id="graphs">
        <div class="panel-heading"><h4>Admin - Support </h4></div>
        <div class="panel-body">

            <h4>Ubesvarte henvendelser</h4>

            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>Dato</th>
                    <th>Navn</th>
                    <th>Epost</th>
                    <th>Emne</th>
                    <th>Behandle</th>
                </tr>
                </thead>
                <tbody>

                <?php

                $tickets = get_support();
                foreach ($tickets as $ticket) {
                    echo "<tr>";
                    echo "<td style='width: 15%'>" . $ticket['date'] . "</td>\n";
                    echo "<td style='width: 20%'>" . $ticket['name'] . "</td>\n";
                    echo "<td style='width:15%'>" . $ticket['email'] . "</td>\n";
                    echo "<td style='width: 40%'>" . $ticket['subject'] . "</td>\n";
                    echo "<td style='width: 10%'><a href='index.php?page=admin_support_tickets&reply=" . $ticket['id'] . "'>Behandle</a></td>\n";
                    echo "</tr>\n";
                }

                ?>

                </tbody>
            </table>
        </div>
    </div>

<?php } ?>
