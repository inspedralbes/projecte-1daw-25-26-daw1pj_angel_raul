**GI3P – Gestió d’Incidències Informàtiques**

**Grup**
- DAW1PJX

**Integrants**
- Ángel Domínguez
- Raúl Díaz

**Descripció del projecte**

GI3P (Gestió d’Incidències Informàtiques de l’Institut Pedralbes) és una aplicació web desenvolupada per gestionar incidències informàtiques dins d’un centre educatiu.

El sistema permet registrar incidències, assignar-les a tècnics, fer seguiment de les actuacions i generar informes per a la seva anàlisi.

**Objectius**

Els objectius principals del projecte són:

- Gestionar incidències informàtiques de manera centralitzada
- Assignar i organitzar el treball dels tècnics
- Registrar actuacions i temps invertit
- Controlar l’estat de les incidències
- Generar informes per departaments i tècnics
- Registrar i analitzar accessos a l’aplicació

**Tecnologies utilitzades**
- PHP (procedural)
- MySQL
- MongoDB (logs d’accés i estadístiques)
- HTML5, CSS3, Bootstrap
- JavaScript
- Docker / Docker Compose
- Git + GitHub

**Funcionalitats del sistema**

**Gestió d’incidències*
- Crear incidències
- Llistar incidències
- Veure detall d’una incidència
- Modificar incidència (prioritat, tècnic, tipus)
- Tancar incidències

**Actuacions**
- Registrar actuacions sobre incidències
- Guardar temps invertit
- Indicar si l’actuació és visible per l’usuari
- Historial complet d’actuacions

**Informes**
- Informe de tècnics (temps i incidències actives)
- Consum per departaments
- Estadístiques d’ús de l’aplicació

**Sistema de logs**
- Registre d’accessos amb MongoDB
- Estadístiques d’ús
- Filtres per data, usuari i pàgina

**Base de dades**
**MySQL (relacional)*

S’encarrega de la gestió principal del sistema:

- USUARIS
- DEPARTAMENTS
- INCIDÈNCIES
- ACTUACIONS
- TÈCNICS
- TIPUS D’INCIDÈNCIA

Relacions:

- Una incidència pertany a un departament
- Una incidència s’assigna a un tècnic
- Una incidència pot tenir múltiples actuacions
- Cada actuació pertany a una incidència

**MongoDB (logs)**

S’utilitza per emmagatzemar:

- URL visitada
- Mètode HTTP
- Usuari autenticat (o null)
- IP del client
- Data i hora
- User-Agent del navegador

Inclou agregacions per:

- Pàgines més visitades
- Usuaris més actius
- Accessos per dia

**Estructura del projecte**
/projecte
├── index.php
├── incidencies.php
├── crear_incidencia.php
├── detall_incidencia.php
├── afegir_actuacio.php
├── connexio.php
├── header.php
├── footer.php
├── /css
├── /js
├── /img

**Instal·lació i execució (Docker)**
**Requisits previs*
- Docker
- Docker Compose

**Execució del projecte**
docker compose up -d

**Configuració de base de dades**
**MySQL*
- Creació automàtica amb Docker
- Dades inicials incloses al projecte

**MongoDB*
- Configurat per registrar logs automàticament
- Connexió mitjançant variable d’entorn:

MONGODB_URI=mongodb://mongodb:27017

**Usuaris i rols**
**Professor / Usuari*
- Crear incidències
- Consultar estat d’incidències

**Tècnic*
- Veure incidències assignades
- Registrar actuacions
- Tancar incidències

**Administrador*
- Assignar incidències
- Gestionar prioritat i tipus
- Accedir a informes i estadístiques

**Metodologia de treball**

El projecte s’ha desenvolupat amb metodologia **SCRUM**:

- Treball en parelles
- Sprints setmanals
- Gestió de tasques amb TAIGA
- Revisió contínua del codi

**Control de versions**

El projecte utilitza GitHub:

- Branca principal: main
- Branca de desenvolupament: development
- Treball per funcionalitats en branques
- Pull Requests per integrar canvis
- Commits freqüents i descriptius

**Desplegament en producció**

L’aplicació es desplega en un servidor real:

- Servidor PHP + MySQL
- Domini:
g7.daw.inspedralbes.cat
- Pujada via SSH
- Connexió a base de dades en producció
- Revisió d’errors con logs d’Apache
