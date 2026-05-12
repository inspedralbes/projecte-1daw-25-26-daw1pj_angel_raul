**GI3P – Gestió d’Incidències Informàtiques**
Grup:
DAW1PJX

**Integrants**
Ángel Domínguez
Raúl Díaz
Objectiu del projecte

Desenvolupar una aplicació web per a la gestió d’incidències informàtiques en un centre educatiu.
Permet registrar incidències, assignar-les a tècnics, fer seguiment d’actuacions i consultar informes.

**Tecnologies utilitzades**
PHP (procedural)
MySQL
HTML5, CSS3, Bootstrap
JavaScript
MongoDB (logs)
Docker
Git + GitHub

**Funcionalitats principals**
  Crear incidències
  Llistar incidències
  Veure detall d’una incidència
  Assignar tècnic, tipus i prioritat
  Registrar actuacions
  Tancar incidències
  Consultar incidències per tècnic
  Informes per departaments

**Base de dades**
MySQL per la gestió principal (incidències, usuaris, tècnics, departaments, actuacions)
MongoDB per registrar logs d’accés a l’aplicació

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


**Metodologia de treball**
Metodologia SCRUM
Treball en parelles
Gestió de tasques amb TAIGA
Sprints setmanals

**Control de versions**
GitHub obligatori
Branches (main / development)
Commits freqüents i clars
Pull Requests per integrar canvis

**Objectiu del desplegament*
Aplicació funcional en servidor real

Desplegament amb domini del tipus:

g7.daw.inspedralbes.cat
Connexió a base de dades en producció
Revisió d’errors amb logs del servidor
