# Promotional Shopper
parses an Product XML Feed on the CLI and applies a promotion based on products

## Purpose
This was part of a technical test. The aim is to take an XML feed containing product data and apply a promotion to it.

## Installing
The code is written using the Symfony Console component. To install the dependancies simply call ```composer install```.

The script will update the given XML schema and save it back to disk, this is saved in the ```data/output/``` directory. Please make sure it has appropriate permissions.

## Command Line Usage
You can run the script on the command line simply by calling the ```command.php``` file. This will bring up the Symfony Console help screen by default.

The command you're interested in is the ```promotional:shopper```.

Using the example files provided a simple execution might look like this.
```bash
php command.php promotional:shopper --file="data/xml/example.xml"
```

If you wish to specify a promotion simply append a ```--promotion="Promo"``` to the command like so.
```bash
php command.php promotional:shopper --file="data/xml/example.xml" --promotion="Promo"
```

## Promo Codes
Rather than typing in the long fulltext promotions I've instead opted for shorter promo codes. They are as follows.

* ThreeForTwo - which will take the cheapest item off the bill for every 3 items you have.
* HalfPriceHairCombo - which will give you 50% off conditioner for a corresponding shampoo.


## Example Data

The example XML file given for a normal feed;
```xml
<?xml version="1.0" encoding="UTF-8"?>
<order>
    <products>
        <product title="Rimmel Lasting Finish Lipstick 4g" price="4.99">
            <category>Lipstick</category>
        </product>
        <product title="Sebamed Anti-Dandruff Shampoo 200ml" price="4.99">
            <category>Shampoo</category>
        </product>
    </products>
    <total>9.98</total>
</order>
```

This is an sample XML file which satisifies the first feature described in the Gherkin spec.
```xml
<?xml version="1.0" encoding="UTF-8"?>
<order>
    <products>
        <product title="Rimmel Lasting Finish Lipstick 4g" price="4.99">
            <category>Lipstick</category>
        </product>
        <product title="bareMinerals Marvelous Moxie Lipstick 3.5g" price="13.95">
            <category>Lipstick</category>
        </product>
        <product title="Rimmel Kate Lasting Finish Matte Lipstick" price="5.49">
            <category>Lipstick</category>
        </product>
    </products>
    <total>24.43</total>
</order>
```

This is an sample XML file which satisfies the __third__ feature described in the Gherkin spec.
```xml
<?xml version="1.0" encoding="UTF-8"?>
<order>
    <products>
        <product title="Sebamed Anti-Dandruff Shampoo 200ml" price="4.99">
            <category>Shampoo</category>
        </product>
        <product title="L'Oréal Paris Hair Conditioner 250ml" price="5.50">
            <category>Conditioner</category>
        </product>
    </products>
    <total>10.49</total>
</order>
```
