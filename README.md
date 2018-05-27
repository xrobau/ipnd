# Australian IPND File Generator

You are expected to know what you are doing.

Licenced under the AGPLv3.

Example code:

    <?php
    include 'config.php';
    include 'vendor/autoload.php';
    
    use AussieVoIP\IPND\IPND;
    use AussieVoIP\IPND\Transaction;
    use AussieVoIP\IPND\Record;
    use AussieVoIP\IPND\Records\Entity;
    use AussieVoIP\IPND\Records\Address;
    
    // An Entity is assigned to the number. It can be PERSON, BUSINESS, GOVERMENT, etc..
    $e = new Entity("PERSON");
    $e->setName("Herp L. Derpinson", "Mr");
    $e->setContactNum("0402000000");
    
    $f = new Entity("BUSINESS");
    $f->setName("Extremely Long Name Pty Ltd, Trading as Stupidly Long Name Incorporated");
    $f->setContactNum("0402000000");
    
    // This is a physical Address. You should purchase the Australia Post Postcode Map CSV
    // file, and put it in the data directory. See the POSTCODE.md file there. There is an
    // older sample.csv there which will help you to get started.
    $a = new Address();
    $a->setStreetNumber("1");
    $a->setStreetName("FAKE", "ST");
    $a->setLocality("4680", "GLADSTONE DC");

    // This is the File Sequence Number
    $i = new IPND(2);
    
    // This is where you'd extract your numbers, and create your entities/addresses
    $nums = [ "0749700000" => $e, "0749700001" => $f, "0749700002" => $e ];

    foreach ($nums as $x => $ent) {
        $t = new Transaction;
        $t->addEntry(Record::getElement("PublicNumber", $x));
        $t->addEntry(Record::getElement("UsageCode")->setEntity($ent));
        $t->addEntry(Record::getElement("ServiceStatusCode", "C"));
        $t->addEntry(Record::getElement("PendingFlag", "N"));
        $t->addEntry(Record::getElement("CancelPendingFlag", "N"));
        $t->addEntry(Record::getElement('CustomerName')->setEntity($ent));
        $t->addEntry(Record::getElement('FindingName')->setEntity($ent));
        $t->addEntry(Record::getElement('ServiceAddress')->setAddress($a));
        $t->addEntry(Record::getElement('DirectoryAddress')->setAddress($a));
        $t->addEntry(Record::getElement('ListCode', 'UL'));
        $t->addEntry(Record::getElement('CustomerContact')->setEntity($ent));
        $t->addEntry(Record::getElement('TransactionDate', IPND::renderDate()));
        $t->addEntry(Record::getElement('ServiceStatusDate', IPND::renderDate()));
        $i->addTransaction($t);
    }

    // Now that you have created the IPND with all its transactions, this outputs
    // everything in the correct format.
    $i->render();



