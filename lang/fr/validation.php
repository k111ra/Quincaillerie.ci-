<?php

return [

  /*
    |--------------------------------------------------------------------------
    | Lignes de validation
    |--------------------------------------------------------------------------
    |
    | Les lignes suivantes contiennent les messages d'erreur par défaut utilisés
    | par la classe de validation. Certaines de ces règles ont plusieurs versions,
    | comme les règles de taille. N'hésitez pas à modifier ces messages ici.
    |
    */

  'accepted' => 'Le champ :attribute doit être accepté.',
  'accepted_if' => 'Le champ :attribute doit être accepté lorsque :other est :value.',
  'active_url' => 'Le champ :attribute n\'est pas une URL valide.',
  'after' => 'Le champ :attribute doit être une date postérieure au :date.',
  'after_or_equal' => 'Le champ :attribute doit être une date postérieure ou égale au :date.',
  'alpha' => 'Le champ :attribute ne doit contenir que des lettres.',
  'alpha_dash' => 'Le champ :attribute ne doit contenir que des lettres, des chiffres, des tirets et des underscores.',
  'alpha_num' => 'Le champ :attribute ne doit contenir que des lettres et des chiffres.',
  'array' => 'Le champ :attribute doit être un tableau.',
  'before' => 'Le champ :attribute doit être une date antérieure au :date.',
  'before_or_equal' => 'Le champ :attribute doit être une date antérieure ou égale au :date.',
  'between' => [
    'array' => 'Le champ :attribute doit avoir entre :min et :max éléments.',
    'file' => 'Le fichier :attribute doit avoir une taille entre :min et :max kilo-octets.',
    'numeric' => 'La valeur de :attribute doit être comprise entre :min et :max.',
    'string' => 'Le texte :attribute doit contenir entre :min et :max caractères.',
  ],
  'boolean' => 'Le champ :attribute doit être vrai ou faux.',
  'confirmed' => 'Le champ de confirmation :attribute ne correspond pas.',
  'current_password' => 'Le mot de passe est incorrect.',
  'date' => 'Le champ :attribute n\'est pas une date valide.',
  'date_equals' => 'Le champ :attribute doit être une date égale à :date.',
  'date_format' => 'Le champ :attribute ne correspond pas au format :format.',
  'declined' => 'Le champ :attribute doit être refusé.',
  'declined_if' => 'Le champ :attribute doit être refusé lorsque :other est :value.',
  'different' => 'Les champs :attribute et :other doivent être différents.',
  'digits' => 'Le champ :attribute doit contenir :digits chiffres.',
  'digits_between' => 'Le champ :attribute doit contenir entre :min et :max chiffres.',
  'dimensions' => 'Les dimensions de l\'image :attribute sont invalides.',
  'distinct' => 'Le champ :attribute a une valeur en double.',
  'email' => 'Le champ :attribute doit être une adresse e-mail valide.',
  'ends_with' => 'Le champ :attribute doit se terminer par l\'une des valeurs suivantes : :values.',
  'enum' => 'La valeur sélectionnée pour :attribute est invalide.',
  'exists' => 'La valeur sélectionnée pour :attribute est invalide.',
  'file' => 'Le champ :attribute doit être un fichier.',
  'filled' => 'Le champ :attribute doit avoir une valeur.',
  'gt' => [
    'array' => 'Le champ :attribute doit avoir plus de :value éléments.',
    'file' => 'Le fichier :attribute doit être supérieur à :value kilo-octets.',
    'numeric' => 'La valeur de :attribute doit être supérieure à :value.',
    'string' => 'Le texte :attribute doit contenir plus de :value caractères.',
  ],
  'gte' => [
    'array' => 'Le champ :attribute doit avoir :value éléments ou plus.',
    'file' => 'Le fichier :attribute doit être supérieur ou égal à :value kilo-octets.',
    'numeric' => 'La valeur de :attribute doit être supérieure ou égale à :value.',
    'string' => 'Le texte :attribute doit contenir :value caractères ou plus.',
  ],
  'image' => 'Le champ :attribute doit être une image.',
  'in' => 'La valeur sélectionnée pour :attribute est invalide.',
  'in_array' => 'Le champ :attribute n\'existe pas dans :other.',
  'integer' => 'Le champ :attribute doit être un entier.',
  'ip' => 'Le champ :attribute doit être une adresse IP valide.',
  'ipv4' => 'Le champ :attribute doit être une adresse IPv4 valide.',
  'ipv6' => 'Le champ :attribute doit être une adresse IPv6 valide.',
  'json' => 'Le champ :attribute doit être une chaîne JSON valide.',
  'lt' => [
    'array' => 'Le champ :attribute doit avoir moins de :value éléments.',
    'file' => 'Le fichier :attribute doit être inférieur à :value kilo-octets.',
    'numeric' => 'La valeur de :attribute doit être inférieure à :value.',
    'string' => 'Le texte :attribute doit contenir moins de :value caractères.',
  ],
  'lte' => [
    'array' => 'Le champ :attribute ne doit pas avoir plus de :value éléments.',
    'file' => 'Le fichier :attribute doit être inférieur ou égal à :value kilo-octets.',
    'numeric' => 'La valeur de :attribute doit être inférieure ou égale à :value.',
    'string' => 'Le texte :attribute doit contenir :value caractères ou moins.',
  ],
  'mac_address' => 'Le champ :attribute doit être une adresse MAC valide.',
  'max' => [
    'array' => 'Le champ :attribute ne doit pas avoir plus de :max éléments.',
    'file' => 'Le fichier :attribute ne doit pas dépasser :max kilo-octets.',
    'numeric' => 'La valeur de :attribute ne doit pas dépasser :max.',
    'string' => 'Le texte :attribute ne doit pas dépasser :max caractères.',
  ],
  'mimes' => 'Le champ :attribute doit être un fichier de type : :values.',
  'mimetypes' => 'Le champ :attribute doit être un fichier de type : :values.',
  'min' => [
    'array' => 'Le champ :attribute doit avoir au moins :min éléments.',
    'file' => 'Le fichier :attribute doit avoir au moins :min kilo-octets.',
    'numeric' => 'La valeur de :attribute doit être au moins de :min.',
    'string' => 'Le texte :attribute doit contenir au moins :min caractères.',
  ],
  'multiple_of' => 'La valeur de :attribute doit être un multiple de :value.',
  'not_in' => 'La valeur sélectionnée pour :attribute est invalide.',
  'not_regex' => 'Le format de :attribute est invalide.',
  'numeric' => 'Le champ :attribute doit être un nombre.',
  'password' => 'Le mot de passe est incorrect.',
  'present' => 'Le champ :attribute doit être présent.',
  'prohibited' => 'Le champ :attribute est interdit.',
  'prohibited_if' => 'Le champ :attribute est interdit lorsque :other est :value.',
  'prohibited_unless' => 'Le champ :attribute est interdit sauf si :other est dans :values.',
  'prohibits' => 'Le champ :attribute interdit la présence de :other.',
  'regex' => 'Le format de :attribute est invalide.',
  'required' => 'Le champ :attribute est obligatoire.',
  'required_array_keys' => 'Le champ :attribute doit contenir des entrées pour : :values.',
  'required_if' => 'Le champ :attribute est obligatoire lorsque :other est :value.',
  'required_unless' => 'Le champ :attribute est obligatoire sauf si :other est dans :values.',
  'required_with' => 'Le champ :attribute est obligatoire lorsque :values est présent.',
  'required_with_all' => 'Le champ :attribute est obligatoire lorsque :values sont présents.',
  'required_without' => 'Le champ :attribute est obligatoire lorsque :values n\'est pas présent.',
  'required_without_all' => 'Le champ :attribute est obligatoire lorsqu\'aucun de :values n\'est présent.',
  'same' => 'Les champs :attribute et :other doivent correspondre.',
  'size' => [
    'array' => 'Le champ :attribute doit contenir :size éléments.',
    'file' => 'Le fichier :attribute doit faire :size kilo-octets.',
    'numeric' => 'La valeur de :attribute doit être :size.',
    'string' => 'Le texte :attribute doit contenir :size caractères.',
  ],
  'starts_with' => 'Le champ :attribute doit commencer par l\'une des valeurs suivantes : :values.',
  'string' => 'Le champ :attribute doit être une chaîne de caractères.',
  'timezone' => 'Le champ :attribute doit être un fuseau horaire valide.',
  'unique' => 'La valeur du champ :attribute est déjà utilisée.',
  'uploaded' => 'Le fichier :attribute n\'a pas pu être téléchargé.',
  'url' => 'Le champ :attribute doit être une URL valide.',
  'uuid' => 'Le champ :attribute doit être un UUID valide.',

  /*
    |--------------------------------------------------------------------------
    | Lignes de validation personnalisées
    |--------------------------------------------------------------------------
    |
    | Vous pouvez spécifier des messages de validation personnalisés pour les
    | attributs en utilisant la convention "attribute.rule" pour nommer les lignes.
    | Cela permet de spécifier un message personnalisé pour une règle d'attribut donnée.
    |
    */

  'custom' => [
    'attribute-name' => [
      'rule-name' => 'message-personnalisé',
    ],
  ],

  /*
    |--------------------------------------------------------------------------
    | Attributs de validation personnalisés
    |--------------------------------------------------------------------------
    |
    | Les lignes suivantes sont utilisées pour échanger notre espace réservé
    | d'attribut avec quelque chose de plus convivial, comme "Adresse E-Mail"
    | au lieu de "email". Cela permet de rendre notre message plus expressif.
    |
    */

  'attributes' => [],

];
