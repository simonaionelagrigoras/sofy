# Sofy (Online Software Repository)
## Motas David 
## Grigoras Simona
## Grigoras Marian
## Programare Web (Facultatea de Informatica)
 ### Cerinte:
 Sa se realizeze o aplicatie Web care gestioneaza un depozit online de aplicatii (software repository). Acestea vor putea 
 fi transferate prin ‘upload’ de catre utilizatorii autentificati. Aplicatiile incarcate vor putea fi grupate dupa diverse 
 criterii (precum platforma hardware, sistemul de operare, tipul licentei, functionalitatile oferite (e.g., utilitar, 
 suita de birou, instrument Internet) etc. sau pe baza unor termeni de continut (i.e. clasificare via tagging). 
 Sistemul va permite adaugarea unor informatii suplimentare pentru fiecare aplicatie incarcata, precum descrierea, 
 situl Web oficial, istoricul versiunilor, frecventa actualizarilor si altele. De asemenea, pentru fiecare aplicatie, 
 vor fi afisate data incarcarii, numarul de download-uri, marimea, alte aplicatii similare. Fiecare utilizator va avea un 
 profil unde vor putea fi vizualizate toate aplicatiile incarcate de acesta. Sistemul va oferi si o interfata de management al
 software-ului la nivel de utilizator sau la nivel de administrator, rapoartele generate fiind disponibile in formatele HTML,
 CSV si PDF. Bonus: preluarea automata a datelor disponibile pe situri de profil precum Alternativeto.net si Softpedia. 

 ## Prezentare implementare
Aplicatia este implementata folosind HTML, CSS, PHP. Urmatorul tabel prezinta tehnologiile folosite si cum ne ajuta acestea la implementare:
![Tabel](https://i.imgur.com/uMssgks.png)
![Tabel1](https://i.imgur.com/W1Kjinz.png)

 ## Diagrame UML / funcționale
 Diagrama modelelor
Aceasta diagrama prezinta diferitele entitati ale aplicatiei.

### User (username: String, password: String, websites: Array)
### Snapshot (formData: Object, published_at: Date, href: String)
![Diagrama](https://i.imgur.com/tQayRAb.png)

 ## Diagrama unui flow normal de interactiune
Aceasta diagrama prezinta un flow normal al unui utilizator.
![Diag](https://i.imgur.com/xR9z1LY.png)

 ## Interfață - CSS & BEM
Indiferent de metodologia pe care o alegem să o utilizați în proiecte., vom  beneficia de avantajele CSS și UI mai structurate. Unele stiluri sunt mai puțin stricte și mai flexibile, în timp ce altele sunt mai ușor de înțeles și se adaptează într-o echipă.
Motivul pentru care am ales BEM peste alte metodologii se limitează la aceasta: este mai puțin confuz decât alte metode, dar ne oferă încă arhitectura bună pe care o dorim și cu o terminologie ușor de recunoscut.
![Interfata](https://github.com/simonaionelagrigoras/sofy/blob/master/documentation/first-design-attempt.png?raw=true)

## Pagina de "My Acount"
![myAcount](https://scontent.fsbz1-1.fna.fbcdn.net/v/t1.15752-9/54433960_2296037633782321_1875070060146458624_n.png?_nc_cat=102&_nc_eui2=AeHjJ5NplQ3X_C6htHugWGwbY2RAHZTkeV07u0XheG784NNAlUCiILndHfnLQL3MBq9vVkvVAqcG9bYWklCimtTq5I2YTvVOYH8CNNC_oiyzTw&_nc_ht=scontent.fsbz1-1.fna&oh=d00f341dd37b87f97fbb3dbd569ca66e&oe=5D3C0ABE)




 ## Cum se va lucra
### Metodologia Agile
Grupul de metode Agile este bazat pe dezvoltarea iterativa si incrementala acolo unde specificatiile si solutiile provin din colaborarea intre echipe organizate individual, dar care au acelasi scop comun.
Aceste metode au la baza 12 principii:

1. Satisfacerea clientilor, prin livrarea rapida de software utilizabil
2.  Intampinarea modificarii specificatiilor, chiar si tarziu in implementare
3.  Software-ul utilizabil este livrat frecvent (la nivel de saptamani)
4.  Software-ul utilizabil reprezinta principala masura a progresului
5.  Dezvoltare sustinuta, capabila sa pastreze un pas constant
6.  Cooperare apropiata intre dezvoltatori si clienti
7.  Conversatia fata-in-fata este cel mai bun mod de comunicare
8.  Proiectele sunt construite de indivizi motivati, credibili
9.  Simplitate
10. Echipe organizate individual
11. Adaptare la circumstante schimbatoare.
12. Atentia constanta pentru excelenta tehnica si design bun.
![Metodologii](http://www.trilex.ro/images/scrum1.gif)
 

 
SCRUM este un schelet ce contine un set de practici si diferite roluri. Principalele roluri din SCRUM sunt:

 - “Scrum Master” – este cel care mentine procesele
 -  “Detinatorul produsului” – cel care reprezinta investitorii si afacerea
 -  “Echipa” – un grup de aproximativ 7 oameni ce fac analiza, proiectarea si implementarea

In timpul fiecarui “sprint” (de obicei cu o durata de 2-4 sapatamani), echipa creaza un increment ce poate fi livrat. Setul de caracteristici ce intra intr-un “sprint” provin din “backlog”-ul proiectului, care reprezinta un set prioritizat de cerinte de nivel inalt ce trebuiesc realizate.  In timpul unei sedinte de planificare a sprint-ului, se stabilesc cerintele ce vor intra in sprint. Cerintele sunt “inghetate” in timpul unui sprint. Sprint-ul trebuie sa se incheie la timp. Daca cerintele nu sunt implementate complet, ele se intorc in backlog-ul proiectului. Dupa terminarea unui sprint, echipa trebuie sa demonstreze functionarea software-ului.

Avantaje:

 - Economisirea de timp si bani
 - Rapiditatea implementarii si usurinta de a corecta eventualele erori
 - Vizibilitate a implementarii proiectului
 - Feedback continuu de la client
 - Usurinta de a face fata schimbarilor
 
Organizarea muncii
Sprinturi
Vom lucra in sprinturi de o saptamana. In fiecare sprint se va livra o functionalitate noua, sub forma unui MVP functional.
Task planning / tracking
Pentru a urmari progresul taskurilor vom folosi un tool free, ClubHouse (https://clubhouse.io/). Acesta ne va permite sa organizam munca in sprinturi si sa vedem care sunt Milestones si Deliverables. Estimand fiecare story, putem aproxima data completarii unei functionalitati.
![ClubHose](https://i.imgur.com/cNjLb9Y.png)


