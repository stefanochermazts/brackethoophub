# ANALISI\_FUNZIONALE

## 1. Obiettivo

Definire le funzionalità chiave e i flussi operativi dell’applicazione Laravel TALL per la gestione di piccoli tornei di pallacanestro, analizzando i principali competitor internazionali e individuando le feature più utili per ciascun attore.

## 2. Analisi dei Competitor

| Software               | Target                        | Punti di Forza                                                  | Criticità                                  |
| ---------------------- | ----------------------------- | --------------------------------------------------------------- | ------------------------------------------ |
| Challonge              | Tornei di tutti gli sport     | Bracket single/elimination; interfaccia intuitiva; API pubblica | Funzionalità statistiche limitate          |
| TournamentSoftware.com | Settore amatoriale/pro        | Generazione automatica calendari; mobile scoring                | Costi elevati per piccoli gruppi           |
| LeagueRepublic         | Leghe e tornei                | Gestione gironi e divisioni; iscrizioni online                  | Interfaccia datata                         |
| Tournify               | Eventi sportivi               | Multilingua; notifiche push; moduli di pagamento                | Statistiche play-by-play non approfondite  |
| GameChanger            | Baseball/Basketball giovanile | Statistiche live; app mobile per coach; scouting avanzato       | Complesso per tornei di piccole dimensioni |

### Insights Principali

* **Bracket automation**: generazione rapida di tabelloni eliminatori e a gironi.
* **Scoring mobile**: app o form web responsive per inserimento in tempo reale.
* **Dashboard statistica**: visualizzazioni trend, heatmap, classifiche.
* **Gestione utenti**: iscrizioni, ruoli, permessi.
* **Comunicazioni**: email/SMS e notifiche push.

## 3. Attori e Casi d’Uso

1. **Amministratore della piattaforma**

   * Gestisce utenti e permessi a livello globale
   * Configura impostazioni generali
   * Monitora integrità del sistema e backup
2. **Organizzatore**

   * Crea e configura tornei
   * Genera e modifica calendari
   * Assegna ruoli (allenatori, scorers)
3. **Società/Club**

   * Iscrive squadre e gestisce roster
   * Gestisce pagamenti e certificati medici
4. **Allenatore**

   * Seleziona formazioni e lineup
   * Inserisce statistiche post-match
   * Consulta report e trend
5. **Giocatore**

   * Visualizza profilo e statistiche personali
   * Consulta timeline e milestone
6. **Visitatore/Sponsor**

   * Esplora tornei pubblici
   * Consulta risultati e news

## 4. Funzionalità Principali per l’Amministratore

* **Gestione utenti, ruoli e permessi a livello di piattaforma**

  * Interfaccia dedicata per creare, modificare e disabilitare account utente; definizione di ruoli predefiniti e permessi granulari per controllare l’accesso a funzionalità specifiche (es. creazione tornei, editing calendario, inserimento statistiche).
* **Configurazione impostazioni globali (date, formati, notifiche)**

  * Pannello di amministrazione per impostare fuso orario predefinito, formati di data/ora, lingue supportate e template per notifiche email/SMS; gestione centralizzata di chiavi API per integrazioni esterne.
* **Monitoraggio sistema e log**

  * Dashboard con visualizzazione in tempo reale di metriche chiave (uptime, utilizzo CPU/memoria), consultazione dei log di sistema e applicazione, ricerca avanzata per eventi e errori e configurazione di alert automatici via email o webhook.
* **Backup e restore del database**

  * Funzionalità per pianificare backup automatici periodici, conservazione di versioni multiple, compressione e archiviazione su storage esterno (es. S3); procedura di restore one-click per ripristini rapidi e test di integrità post-restore.

## 5. Funzionalità Principali per gli Organizzatori

* **Creazione Torneo Guidata**

  * Wizard interattivo che accompagna l’organizzatore nella definizione di nome torneo, date di inizio/fine, sedi di gioco, categorie partecipanti e regole (durata tempi, punteggi, criteri di spareggio). Include validazioni contestuali e suggerimenti automatici per evitare conflitti di orario.

* **Generazione e Modifica Calendario**

  * Motore di scheduling che supporta formati round‑robin, knockout e strutture miste; consente di impostare vincoli come giorni disponibili per ogni campo. Modalità drag & drop per spostare partite manualmente, con ricalcolo automatico dei turni successivi e notifica dei cambiamenti a squadre coinvolte.

* **Assegnazione Ruoli e Permessi**

  * Sistema di gestione dei collaboratori che permette di invitare e assegnare ruoli a organizzatori aggiuntivi, allenatori e scorer. Ogni ruolo ha un set di permessi preconfigurati (es. solo lettura calendario, modifica referti, invio comunicazioni) modificabili dall’amministratore del torneo.

* **Reportistica e Export**

  * Funzionalità di esportazione multipla in formati PDF, CSV e ICS, con template personalizzabili. Include report su classifiche generali, statistiche di squadra e singoli giocatori, calendari stampabili e link di condivisione via URL protetto.

* **Comunicazioni Centralizzate**

  * Modulo per invio massivo di email e SMS ai partecipanti, squadre e staff. Supporto per template dinamici (es. notifiche di cambio orario, promemoria match, risultati finali) e history delle comunicazioni inviate con possibilità di filtri per data e destinatari.

* **Referto Elettronico Dettagliato**

  * Pannello di inserimento dati partita con sessioni temporizzate: rilevazione di tiri da 2 e 3 punti (segnati/falliti), tiri liberi (segnati/mancati), falli personali e di squadra per ogni quarto. I dati vengono validati in real-time e integrati nella dashboard statistica con indicatori di precisione e mappe dei tiri. **Interfaccia ottimizzata per dispositivi mobili e desktop**, garantendo usabilità e velocità di inserimento direttamente dal campo. I dati vengono validati in real-time e integrati nella dashboard statistica con indicatori di precisione e mappe dei tiri.. Funzionalità per le Società/Club

## 6. Funzionalità per le Società/Club

* **Gestione Roster**

  * Pannello dedicato per creare e modificare roster di squadra, con campi per nome, età, ruolo e stati dei certificati medici; possibilità di caricare documenti (es. certificati) e validare scadenze tramite promemoria automatico.

* **Iscrizione e Pagamento**

  * Modulo online intuitivo per registrare squadre al torneo, con integrazione di gateway di pagamento (Stripe, PayPal); gestione automatica di fatture e ricevute, notifiche di pagamento riuscito o mancato e storico transazioni.

* **Visualizzazione Calendario e Avvisi**

  * Dashboard per le società con calendario interattivo delle partite della propria squadra, filtri per date e campi, e sistema di notifiche push o email per variazioni di orario, modifiche ubicazione campo o posticipo/anticipo delle partite.

* **Compilazione Statistiche**

  * Interfaccia web completa per inserire e rivedere statistiche di squadra e individuali. Parametri principali rilevati:

    * **Punti segnati**: tiri da 2 punti, tiri da 3 punti, tiri liberi (segnati/mancati)
    * **Rimbalzi**: offensivi e difensivi
    * **Assist**: passaggi che generano canestro
    * **Palle perse**: turnover offensivi
    * **Steal**: palle recuperate in difesa
    * **Stoppate**: blocchi difensivi
    * **Falli**: personali, tecnici e di squadra per tempo
    * **Minuti giocati**: tempo di gioco per atleta
    * **Percentuali di tiro**: percentuale da 2, da 3 e liberi
    * **Valutazione / Efficiency**: indicatore sintetico basato su formula standard (Punti + Rimbalzi + Assist + Steal + Stoppate - Tiri falliti - Palloni persi - Falli)
    * **Plus/Minus**: differenza di punteggio squadra con atleta in campo
  * Supporto per statistiche avanzate e formule personalizzabili dal club.
  * Funzioni di approvazione/revisione per confermare i dati prima della pubblicazione.
  * **Form mobile-responsive** per permettere la registrazione rapida delle statistiche anche da smartphone e tablet.

## 7. Funzionalità per gli Allenatori

* **Lineup e Formazioni**

  * Interfaccia drag & drop per selezionare quintetto iniziale e panchina, con salvataggio di più combinazioni tattiche e template predefiniti per partite differenti.

* **Inserimento Statistiche Post-match**

  * Modulo dettagliato per registrare performance individuali (punti, rimbalzi, assist, palle perse, stoppate), con breakdown per quarto e funzioni di autocorrezione per dati incoerenti. **Interfaccia mobile-friendly** per consentire agli allenatori di inserire rapidamente i dati dal campo tramite smartphone.

* **Analisi Performance**

  * Dashboard interattiva con grafici trend (andamento punti, efficienza, percentuali di tiro), confronto con medie degli avversari e heatmap di posizionamento sui tiri.

* **Condivisione Report**

  * Generazione automatica di PDF e link protetti per condividere report dettagliati con lo staff, genitori e giocatori, comprensivi di grafici e commenti scaricabili o stampabili.

* **Programmazione Allenamenti**

  * Calendario allenamenti integrato con note campo, lista esercizi e possibilità di assegnare compiti ai giocatori, con notifiche push per promemoria.

## 8. Funzionalità per i Giocatori

* **Profilo Personale**

  * Pagina dedicata con visualizzazione di statistiche cumulative (punti totali, media punti, rimbalzi, assist, percentuali di tiro), informazioni personali e storico squadre/tornei a cui il giocatore ha partecipato.

* **Timeline delle Performance**

  * Sezione temporale che mostra cronologicamente le partite disputate, con punteggi e valutazioni; possibilità di filtrare per torneo, stagione o categoria.

* **Badge e Riconoscimenti**

  * Sistema di achievement per premiare milestone individuali (es. prima doppia doppia, 100 punti segnati nel torneo); badge visualizzati sul profilo e condivisibili sui social.

* **Feedback e Commenti**

  * Funzionalità per ricevere feedback da allenatori o compagni di squadra dopo le partite, con possibilità di commenti pubblici o privati sul profilo.

* **Download Rapporto Personale**

  * Generazione automatica di report PDF con riepilogo stagionale o torneo-specifico, comprensivo di grafici e note tecniche.. Funzionalità per Visitatori/Sponsor

* **Elenco Tornei Pubblici**: filtro per data, luogo e categoria

* **Feed News e Sponsorship**: aggiornamenti e promozioni

## 10. Requisiti Non Funzionali

* **Multilingua (i18n)**

  * Implementazione tramite Laravel Localization e `spatie/laravel-translatable`, con supporto predefinito a italiano, inglese, francese, tedesco, sloveno, croato, serbo e bosniaco; facile aggiunta di nuove lingue via file di traduzione; gestione di fallback automatici e hot-reload delle modifiche.

* **Accessibilità**

  * Conformità WCAG 2.1 AA: utilizzo di HTML semantico, gestione adeguata del focus, attributi ARIA corretti; test automatici con axe-core e audit periodici con Lighthouse; contrast ratio minimo 4.5:1 e supporto completo per navigazione da tastiera.

* **Scalabilità**

  * Architettura stateless per servizi API, caching Redis per le query più frequenti, queue via Laravel Queue per task asincroni (notifiche, invio email); predisposizione per orizzontale scaling su container (es. Kubernetes) e partizionamento del database se necessario.

* **Sicurezza**

  * HTTPS obbligatorio, protezione CSRF/XSS integrata con middleware Laravel; validazione e sanitizzazione server-side di tutti i dati in ingresso; hashing password con bcrypt; audit log per operazioni critiche; gestione sicura di chiavi e segreti tramite variabili d’ambiente e rotazione periodica.

* **Performance**

  * Caricamento time to interactive <2s su connessioni medie; TTFB <200ms per endpoint API principali; ottimizzazione asset (minificazione, concatenazione, caching browser); database indexing strategico e monitoraggio tramite strumenti APM (New Relic, Laravel Telescope).

* **Manutenibilità**

  * Codice documentato con PHPDoc e commenti chiari; test coverage unitari e di integrazione >80% con PHPUnit; pipeline CI/CD su GitHub Actions con linting, test e analisi statica; convenzioni di naming e code style uniformi (PSR-12).

* **Usabilità**

  * Design responsive mobile-first; interfaccia intuitiva con guide contestuali e tooltips; test UX con utenti reali su fasi critiche (creazione torneo, inserimento statistiche); metriche di soddisfazione utente (Net Promoter Score) >80%.

* **Affidabilità**

  * SLA minimo 99.9%; monitoraggio uptime e alert automatici su errori critici; fallback di servizi esterni e retry automatici su invio notifiche; backup giornalieri del database con retention di almeno 30 giorni.

---

*Fine Analisi Funzionale.*
