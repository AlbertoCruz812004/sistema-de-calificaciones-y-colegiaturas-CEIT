
SELECT persona.nombre_persona, persona.apellidos FROM administrativo
INNER JOIN persona ON persona.id = administrativo.id_persona
WHERE administrativo.email = :username AND administrativo.password = :password;