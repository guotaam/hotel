UPDATE membre SET roles = '["ROLE_ADMIN"]' WHERE id = 1;
INSERT INTO membre (
    id,
    email,
    roles,
    password,
    pseudo,
    nom,
    prenom,
    civilite,
    created_at
  )
VALUES (
    id:int,
    'email:varchar',
    'roles:longtext',
    'password:varchar',
    'pseudo:varchar',
    'nom:varchar',
    'prenom:varchar',
    'civilite:varchar',
    'created_at:datetime'
  );