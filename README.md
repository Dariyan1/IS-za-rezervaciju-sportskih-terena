# IS-za-rezervaciju-sportskih-terena

Kada pokrenemo XAMPP Control Panel, potrebno je da kliknemo na config dugme od MySQL-a. Kliknemo na my.ini
U my.ini moramo naci max_allowed_packet i stavitii da je 100M (umjesto defaultnog 1M). Ovo ce nam omoguciti da kad Importujemo bazu podataka phpmyadmin moze da prihvati velicinu slika koje se nalaze u bazi podataka.
Sada mozemo Startovati Apache i MySQL. Kliknemo na dugme Admin kod MySQL-a, i to dugme ce nas odvesti na phpmyadmin gdje trebamo da kreiramo bazu podataka sa imenom: is za rezervaciju sportskih terena
Sada u gornjem dijelu "navigation bara" mozemo naci Import, kliknemo na Import i to ce nas odvesti na stranicu gdje samo trebamo da postavimo datu bazu podataka.
Website folder ubacimo u C:\xampp\htdocs
Ukucamo u browser localhost/IS za rezervaciju sportskih terena
