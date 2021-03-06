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
 


  ### Partea I
  #### Prototip al interfeţei Web
  Specificarea cerinţelor principale:

Pentru proiectele din clasa B: minimal, cele referitoare la funcţionalităţile esenţiale ale aplicaţiei;

Proiectarea şi implementarea interfeţei Web responsive ce va recurge la HTML5 şi CSS3. Vor fi oferite motivaţii asupra alegerii unei/unor anumite idei de design.

 ### Partea a-II-a
 #### Arhitectura aplicaţiei Web 
Prezentarea arhitecturii de ansamblu (e.g., via diagrame UML), plus etapele intermediare ale dezvoltării proiectului.

 ## Prezentare implementare
Aplicatia este implementata folosind HTML, CSS, PHP. Urmatorul tabel prezinta tehnologiile folosite si cum ne ajuta acestea la implementare:

Tehnologii  | Detalii
------------- | -------------
HTML  | Limbajul folosit pentru scrierea paginilor web este HTML. Acesta nu este un limbaj de programare, ci de "formatare" a         textului si foloseste asa numitele marcaje, numite TAG-uri. O alta modalitate este de a folosi un editor HTML,                 asemanator editoarelor de text. In acestea utilizatorul scrie doar continutul paginii web, iar tagurile sunt introduse         de editor in momentul formatarii textului de catre utilizator.
CSS   | CSS este un limbaj care defineste "layout-ul" pentru documentele HTML. CSS acopera culori, font-uri, margini                   (borders), linii, inaltime, latime, imagini de fundal, pozitii avansate si multe alte optiuni. HTML este de multe ori folosit necorespunzator pentru a crea layoutul site-urilor de internet.
PHP   | PHP este un limbaj de programare. Numele PHP provine din limba engleză și este un acronim recursiv : Php: Hypertext           Preprocessor. Folosit inițial pentru a produce pagini web dinamice, este folosit pe scară largă în dezvoltarea                 paginilor și aplicațiilor web. Se folosește în principal înglobat în codul HTML, dar începând de la versiunea 4.3.0 se         poate folosi și în mod „linie de comandă” (CLI), permițând crearea de aplicații independente. Este unul din cele mai           importante limbaje de programare web open-source și server-side, existând versiuni disponibile pentru majoritatea             web serverelor și pentru toate sistemele de operare. Conform statisticilor este instalat pe 20 de milioane de site-uri         web și pe 1 milion de servere web. Este disponibil sub Licenṭa PHP ṣi Free Software Foundation îl consideră a fi un           software liber. ( Sursa: www.wikipedia.ro)
JQuery | jQuery este o platformă de dezvoltare JavaScript, concepută pentru a ușura și îmbunătăți procese precum traversarea            arborelui DOM în HTML, managementul inter-browser al evenimentelor, animații și cereri tip AJAX. jQuery a fost                gândit să fie cât mai mic posibil, disponibil în toate versiunile de browsere importante existente, și să respecte            filosofia "Unobtrusive JavaScript". Biblioteca a fost lansată in 2006 de către John Resig . (Sursa :                          www.wikipedia.ro)

 

 ## Diagrama unui flow normal de interactiune
Aceasta diagrama prezinta un flow normal al unui utilizator.
![Diag](https://raw.githubusercontent.com/simonaionelagrigoras/sofy/master/documentation/flow_diagram.png)

 ## Diagrama Use-Case
 ![Diagrama-Use-case](https://raw.githubusercontent.com/simonaionelagrigoras/sofy/master/documentation/use_case.png)


 ## Prelucrarea datelor
 Dupa accesarea contului, utilizatorul va putea sa faca management la repositories.
 Orice actiune (listare, adaugare, stergere) va fi facuta folosind ajax call-uri la enpointuri specifice fiecarei actiuni.
 
 Enpointurile vor prelucra datele (upload fisier si adaugare in detalii in baza de date, stergere fisier, modificare detalii in DB, stergere/encriptare date in DB)
 si vor trimite un mesaj de raspuns si un flag success sau error in functie de rezultatul procesarii.
 
 Mesajul primit ii va fi afisat utilizatorului impreuna cu sugestii de actiuni/pasi de urmat in continuare.
 
 Aceasta arhitectura este cunoscuta ca MVC - Model - View - Controller

 ## Pattern-ul MVC
 Exemplu de comunicare intre view, controller si model in timpul interactionarii cu aplicatia:

In momentul logarii, ne aflam in pagina Log in, introducem date in casutele username si password si dam submit, in acest moment componenta controller primeste de la view aceste date, username-ul si parola pe care le-am introdus, controllerul paseaza aceste date modelului iar modelul verifica in baza de date, mai exact in tabela user daca aceste date introduse sunt unice, daca da, atunci modelul ia din tabela datele necesare afisarii urmatorului page, le paseaza controllerului, iar acesta le da mai departe view-ului pentru ca acesta sa afiseze pagina Workspace, daca nu, atunci controllerul da mai departe un mesaj de eroare care este mai apoi afisat in view, in pagina Log in.

(Fiecare pagina mentionata pana acum, ca spre exemplu log in sau workspace sunt viewuri care sunt afisate ca output userului prin procesarea anumitor date de catre controller luate de model din baza de date.)

![MVC](https://scontent-otp1-1.xx.fbcdn.net/v/t1.15752-9/57191731_317141795637152_401147162307592192_n.png?_nc_cat=100&_nc_ht=scontent-otp1-1.xx&oh=fa430c650c1441484a87edc8941ef739&oe=5D72883C)

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

1.  Satisfacerea clientilor, prin livrarea rapida de software utilizabil
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


