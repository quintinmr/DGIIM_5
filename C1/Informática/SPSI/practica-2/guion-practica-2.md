
# Guía para la Realización del Ejercicio sobre RSA y OpenSSL

## Introducción al Algoritmo RSA

RSA es un algoritmo de cifrado asimétrico ampliamente usado en seguridad digital. Este algoritmo, desarrollado en 1977 por Rivest, Shamir y Adleman, permite cifrar y firmar mensajes mediante dos claves: una clave pública y una clave privada. El procedimiento RSA se basa en la dificultad de factorizar grandes números primos, lo que proporciona seguridad en las comunicaciones cifradas y en la autenticidad de los mensajes. OpenSSL implementa RSA mediante herramientas como `pkeyutl` y `rsautl`, permitiendo ejecutar operaciones de cifrado, descifrado, firmado y verificación de mensajes con RSA.

## Ejercicio: Realización del Ejemplo con OpenSSL

Para realizar el ejercicio, siga los pasos a continuación junto a un compañero. Usarán OpenSSL para simular una transmisión segura de un mensaje firmado y cifrado.

### Requisitos previos

1. **Instalar OpenSSL** en ambos equipos.
2. **Configurar Telegram o un medio para compartir archivos** de manera segura.

### Pasos a seguir

#### 1. Generación de Claves
Cada usuario generará su par de claves RSA (pública y privada).

- Usuario Emisor:
  ```bash
  openssl genpkey -algorithm RSA -pkeyopt rsa_keygen_bits:2048 -out 
  privkey-userS.pem 
  openssl pkey -in privkey-userS.pem -out pubkey-userS.pem -pubout
  ```
- Usuario Receptor:
  ```bash
  openssl genpkey -algorithm RSA -pkeyopt rsa_keygen_bits:2048 -out 
  privkey-userR.pem
  openssl pkey -in privkey-userR.pem -out pubkey-userR.pem -pubout
  ```

  **Explicación de las órdenes anteriores**:

  * **Generación de la clave privada:** con openssl **genkey**, invocamos a openssl para generará
  un par de claves (pública y privada), luego con **-algorithm RSA** indicamos que el algoritmo de
  cifrado a usar es RSA, con **-pkeyopt rsa_keygen_bits:2048**, definimos el tamaño de la clave RSA, en
  este caso 2048 bits (cuanto más largo más seguro, generalmente), con **-pkeyopt rsa_keygen_pubexp:3**
  indicamos el exponente público que se usará para la clave, en este caso, 3 (es un valor numérico utilizando
  en combinación con la clave pública para realizar operaciones de cifrado y verificación de firmas. Es una
  de las dos partes que conforman la clave pública en RSA, junto con el módulo). Finalmente,**-out privkey-ID.pem**
  especifica el archivo de salida para la clave privada generada.

  * **Generación de la clave pública:** con openssl **pkey**, llamamos a openssl para realizar operaciones
  con claves (en este caso, extrayendo la clave pública de la privada), con **-in privkey-userS.pem**, especificamos
  el archivo de entrada que contiene la clave privada. Openssl leerá esta clave privada y, a partir de ella,
  derivará la clave pública. Por su parte, **-out pubkey-userS.pem**, define el archivo de salida para la clave pública
  generada y, finalmente, **-pbout**, indica a Openssl que extraiga la clave pública de la clave privada
  proporcionada y la escriba en el archivo de salida. Sin esta opcion, Openssl intentaría exportar la clave privada en 
  lugar de la pública.

**Notas**: 

   * Asegurarse de intercambiar las claves públicas generadas (`pubkey-userS.pem` y `pubkey-userR.pem`).

   * Hay que tener ciudado con usar el mismo exponente público en sistemas de cifrado RSA cuando varios usuarios
   participen en un mismo "círculo" de comunicación. La advertencia se basa en que tener múltiples usuarios con el mismo 
   exponente público puede hacer que sus mensajes cifrados sean vulnerables a ataques de intercepción y descifrado. Se podría
   descifrar el mensaje usando técnicas matemáticas, sin necesidad de la clave privada.

#### 2. Emisión del Mensaje

1. Crear un archivo con el mensaje a enviar:
   ```bash
   echo "Contenido del mensaje" > message-userS.txt
   ```

2. **Firmar el mensaje** utilizando la clave privada del emisor:
   ```bash
   openssl dgst -sha256 -sign privkey-userS.pem -out 
   message-userS.txt.sgn message-userS.txt
   ```

   > **Explicación:** con esta sentencia Openssl crea una firma digital del archivo message-userS.txt, utilizando el
   > algoritmo de hash SHA-256 y una clave privada. La firma generada se guarda en un archivo separado, message-userS.txt.sgn.
   > Con **openssl dgst**, se invoca a Openssl para calcular el digest o hash de un archivo, y puede usarse también para firmarlo 
   > digitalmente. Con **-sha256**, especifica que el algoritmo de hash a usar el SHA-256, que crea un resumen (hash) de 256 bits del 
   > archivo. Este resumen representa el contenido del archivo de manera única, y cualquier cambio en el archivo generaría un hash
   > diferente. Con **-sign privkey-userS.pem** indica que se firmará el hash generado con la clave privada. Al usar la clave privada
   > para firmar el hash, se asegura que solo quien posee esta clave puede generar esa firma. Finalmente, **-out message-userS.txt.sgn**
   > especifica el archivo de salida en el cual se almacenará la firma generada.

   > **Notas:**

      > **¿Qué es un hash?** Generalmente, los archivos que se quieren firmar suelen ser grandes, y firmar un archivo completo
      > directamente podría ser computacionalmente ineficiente. En lugar de eso, se aplica una función hash para reducir el contenido
      > a un resumen (digest) de tamaño fijo, que representa de manera única el contenido del archivo. Así, al firmar el hash en lugar
      > del archivo completo, el proceso es más rápido y eficiente en términos de recursos. Una función hash como SHA-256 genera un único
      > valor para el contenido del archivo. Si se moficia incluso un solo bit del archivo, el hash resultante será completamente diferente.
      > Entonces, al crear una firma digital del hash del archivo, se garantiza que cualquier alteración en el archivo original se detectará
      > porque el hash cambiaría y, por lo tanto, la firma ya no coincidiría en una verificación.

3. **Cifrar el mensaje** con la clave pública del receptor:
   ```bash
   openssl pkeyutl -encrypt -in message-userS.txt -pubin -inkey 
   pubkey-userR.pem -out message-userS.txt.enc
   ```

   > **Explicación:** Esta sentencia utiliza una clave pública para cifrar el contenido de un archivo
   > y produce un archivo cifrado. Este proceso garantiza que solo quien posea la clave privada correspondiente podrá descifrar
   > el archivo, protegiendo así el contenido para que solo el destinatario autorizado pueda leerlo.
   > Con **openssl pkeyutl**, se ejecuta una utilidad de Openssl específica para operaciones de cirfrado y descifrado con claves públicas y 
   > privadas. Con la opción **-encrypt** se indica que se va a cifrar el archivo de entrada, especificado con **-in message-userS.txt**,
   > y con la opción **-pubin**, se indica que la clave proporcionada con **-inkey pubkey-userR.pem**, es una clave pública (la del destinatario).
   > Esta es una opción importante ya que sin ella OpenSSL podría interpretarla como privada.Finalmente, **-out message-userS.txt.enc**
   > define el archivo de salida para almacenar el contenido cifrado.

   > **Nota:** Este proceso de cifrado se basa en la criptografía asimétrica, donde la clave pública se utiliza para cifrar
   > y solo la privada correspondiente puede descrifrar, asegurando que el contenido es seguro para el destinatario específico.

4. Enviar al receptor los archivos `message-userS.txt.sgn` (firma) y `message-userS.txt.enc` (mensaje cifrado).

#### 3. Recepción del Mensaje

1. **Descifrar el mensaje** usando la clave privada del receptor:
   ```bash
   openssl pkeyutl -decrypt -in message-userS.txt.enc -inkey
   privkey-userR.pem -out rec-message-userS.txt
   ```

   > **Explicación:** Esta sentencia descifra un archivo previamente cifrado, utilizando para ello una clave privada y guarda el contenido
   > descifrado en un nuevo archivo. Usa la opción **-decrypt**, indicando que la operación que se realizadŕa es el descrifrado del archivo
   > indicado con la opción **-in message-userS.txt.enc**, usando para ello la clave privada del destinatario (de quien está descifrando), 
   > usando la opción **-inkey privkey-userR.pem**. Finalmente, **-out rec-message-userS.txt**, especifica el archivo de salida donde se almacenará 
   > el contenido descifrado.

2. **Verificar la firma** para asegurar que el mensaje fue enviado por el emisor legítimo:
   ```bash
   openssl dgst -sha256 -verify pubkey-userS.pem -signature
   message-userS.txt.sgn rec-message-userS.txt
   ```

   > **Explicación:** el descifrador no actuará sin tener constancia de que el mensaje que ha recibido proviene
   > realmente de quien dice ser el emisor. Para ello, con esta sentencia, se verifica la firma digital, para así asegurarnos de que 
   > el archivo no ha sido modificado y fue firmado por el propietario de la clave privada correspondiente a la clave pública con
   > la que se firmó. Con la operación **openssl dgst**, se realiza una operación de verificación de firma digital (también sabemos que
   > sirve para hacer hash), y con la opción **-sha256**, se especifica que el algoritmo de hash a utilizar es SHA-256. Esto significa que
   > se generará un hash de 256 bits del contenido del archivo **rec-message-userS.txt** (el descifrado), que se comparará con
   > el hash firmado para verificar la autenticidad e integridad. Con la opción **-verify pubkey-userS.pem** se infica que se va a verificar
   > la firma digital utilizando la clave pública del emisor, y con la opción **-signature message-userS.txt.sgn**, se especifica
   > el archivo que contiene la firma digital.

Si el mensaje de verificación es `Verified OK`, el receptor puede estar seguro de la autenticidad del mensaje y de su integridad.

