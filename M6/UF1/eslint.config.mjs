// import globals from "globals";
// import pluginJs from "@eslint/js";


// export default [
//   {files: ["**/*.js"], languageOptions: {sourceType: "commonjs"}},
//   {languageOptions: { globals: globals.browser }},
//   pluginJs.configs.recommended,
// ];

import globals from 'globals';
import pluginJs from '@eslint/js';
import stylisticJs from '@stylistic/eslint-plugin-js';
//Importa el plugin @stylistic/js 
export default [
  {
    files: ['**/*.js'], // Se aplica a tots els archius JS  
    languageOptions: { 
    sourceType: 'commonjs', // Especifica el tipus de mòdulo (CommonJS) 
    globals: globals.browser // Usa les variables globals per al navegador 
  },
  plugins: {
    '@stylistic/js': stylisticJs, // Aquí registres el plugin importat 
  },
  rules: {
    // Regles del plugin @stylistic/eslint-plugin-js 
    '@stylistic/js/indent': ['error', 2], // Indentació de 2 espais 
    
    'semi': "error", //añade ; al final de cada línea al guardar.

    '@stylistic/js/quotes': ["error", "single"], //cambia a comillas simples los strings

    'curly': "error", //añade claudators {} obligatoriamente en bloques de control

    //'no-unused-vars': ['error'] //marca erros en variables no utilizadas


  } 
 },
  pluginJs.configs.recommended // Extend les regles recomanades d'ESLint per a JavaScript 
]; 