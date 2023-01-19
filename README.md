# EBOOKY LIBRARY
És una biblioteca online on els socis poden llogar e-books. La documentació es troba en la carpeta public

## Home Page
La pàgina principal mostra un fons de llibres i opcions per registrar-se o iniciar sessió.

# Tipus d'usuari
1. **Administrador**: S'encarrega de la gestió dels usuaris, llibres i préstecs.
2. **Soci**: Es registra, inicia sessió, consulta el catàleg i pot lloguar y veure de l'estat dels seus llibres.

## Accions Usuari Soci
1. Sessió
2. Consulta del catàleg
3. Préstec d'un llibre
4. Confirmació del lloguer
5. Pròrroga
6. Sancionar(automàtic) -> import a pagar

### Dashboard Usuari Soci
Vista al seu dashboard amb els seus llibres prestats indicant la data de retornada. En cas de que no hi hagi hi hauría un missatge.
Accés al catàleg de llibres disponibles amb la opció de realitzar i confirmar un préstec.

## Accions Usuari Administrador
1. Sessió
2. Consulta del catàleg de llibres
3. Consulta de les dades de l'usuari, llibres i préstecs
4. Gestió i eliminació del registre d'usuaris, llibres i préstecs
5. Modificació de dades del préstec.

### Dashboard usuari Administrador
Vista al seu dashboard amb tota la informació en taules dels llibres, usuaris i préstecs.

### Funcions de cada taula
Eliminar registres:
- Usuaris: Amb el seu ID
- Llibres: Amb el seu ID
- Préstec: Amb l'ID del llibre i de l'usuari.

Modificar dates de préstecs.
Afegir llibres.


## Catàleg de llibres
Només podràn accedir al catàleg els usuaris que estiguin loguejats. 
Es veurà una taula on s'incorpora les dades bàsiques del llibre:
- ISBN
- títol
- autors
- editorial
- imatge

# Casos

## Lloguer
En el catàleg, amb el botó "Fer préstec" podrem realitzar el lloguer de llibres on es rederigirà a una pàgina de confirmació.
En un principi, els usuaris poden llogar llibres gratuïtament, tots els que vulgui de manera il·limitada.

### Missatge de confirmació
Està la possibilitat de cancelar la demanda abans de confirmar el lloguer del llibre

#### Si hi ha retard...
Per cada dia de retard s'afegirà 0,50€ al cost del lloguer.

# Base de dades
> Users
> Books
  - genres: pot teni més d'un génere
  - authors: Pot tenir més llibres el mateix autor
> Book_rent
  - status code: l'estat en que es troba l'usuari amb el préstec