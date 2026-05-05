# Copilot Prompt: Genera progetto Laravel gestionale

✅ PROMPT DA INCOLLARE IN VS CODE (VERSIONE COMPLETA E PROFESSIONALE)

Copilot, genera un progetto Laravel completo seguendo queste specifiche architetturali.

🎯 OBIETTIVO

Realizzare una webapp gestionale per un’associazione composta da:

- persone (anagrafica unica)
- contatti multipli per persona
- gruppi
- associazioni
- diocesi
- ruoli contestuali (associazione, gruppo, diocesi, sistema)
- assegnazione ruoli tramite pivot polimorfica
- media/file collegabili a persone, gruppi, associazioni, diocesi
- ACL basata su ruoli e permessi
- struttura database normalizzata e scalabile

🧱 1. MODELLI DA CREARE

Genera i seguenti modelli Laravel con migrazioni, factory e relazioni:

1. persons

    id
    first_name
    last_name
    birth_date (nullable)
    gender (nullable)
    notes (nullable)
    created_at
    updated_at
    updated_by_person_id (FK verso persons)

Relazioni:

    hasMany contacts
    morphMany media
    hasMany person_role_assignments

2. contacts

    id
    person_id (FK)
    type (phone, email, pec, whatsapp, telegram, address, social)
    label (personale, ufficio, istituzionale, emergenza…)
    value
    is_primary (boolean)
    created_at
    updated_at

Relazioni:

    belongsTo person

3. associations

    id
    name
    nation
    address
    type
    created_at
    updated_at

Relazioni:

    morphMany media
    morphMany person_role_assignments (tramite entity_type = "association")
    belongsToMany groups

4. dioceses

    id
    name
    country
    region
    city
    created_at
    updated_at

Relazioni:

    morphMany media
    morphMany person_role_assignments (entity_type = "diocese")
    hasMany groups

5. groups

    id
    name
    description
    diocese_id (FK)
    created_at
    updated_at

Relazioni:

    belongsTo diocese
    belongsToMany associations
    belongsToMany persons (tramite contact_group)
    morphMany media
    morphMany person_role_assignments (entity_type = "group")

6. association_group (pivot)

    association_id
    group_id

7. contact_group (pivot)

    person_id
    group_id
    is_member_of_group (boolean)

8. roles (tabella unica dei ruoli)

    id
    name
    context (association, group, diocese, system)
    description
    is_primary (boolean)
    created_at
    updated_at

9. person_role_assignments (pivot polimorfica)

    id
    person_id
    role_id
    entity_id
    entity_type (association, group, diocese, system)
    start_date
    end_date
    notes
    created_at
    updated_at

Relazioni:

    belongsTo person
    belongsTo role
    morphTo entity

10. media (polimorfico)

    id
    file_name
    file_path
    mediaable_id
    mediaable_type
    uploaded_by_person_id
    created_at
    updated_at

Relazioni:

    morphTo mediaable
    belongsTo person (uploaded_by_person_id)

🔐 2. ACL (Access Control List)

Genera:

- system_roles

    id
    name
    description

- permissions

    id
    name
    description

- role_permission (pivot)

    role_id
    permission_id

- person_system_role (pivot)

    person_id
    system_role_id

Implementa middleware:

    CheckRole
    CheckPermission
    CheckContextRole (per ruoli contestuali)

🧩 3. CONTROLLER DA GENERARE

    PersonController
    ContactController
    GroupController
    AssociationController
    DioceseController
    RoleController
    PersonRoleAssignmentController
    MediaController

CRUD completi + validazione + policy ACL.

🗂️ 4. FUNZIONALITÀ DA IMPLEMENTARE

    Upload media (Laravel Storage)
    Relazioni polimorfiche
    Assegnazione ruoli contestuali
    Filtri per contesto (associazione, gruppo, diocesi)
    Dashboard riepilogativa

🧪 5. TEST

Genera test PHPUnit per:

    relazioni
    ACL
    assegnazione ruoli
    media polimorfico

🧱 6. OUTPUT ATTESO

Copilot deve generare:

    tutte le migrazioni
    tutti i modelli
    tutte le relazioni
    tutti i controller
    middleware ACL
    policy
    seeders per ruoli base
    esempi di query Eloquent

🚀 FINE PROMPT
