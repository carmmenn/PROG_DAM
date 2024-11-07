import mysql.connector  # type: ignore

conexion = mysql.connector.connect(
    host='localhost',
    user='root',
    password='curso',
    database='SUPERMERCADO'
)

def connect_to_database():
    if conexion.is_connected():
        print("Conexión exitosa")
    else:
        print("Error en la conexión")
    
def insertar_categoria():
    idcategoria = input("Ingrese el ID de la categoría: ")
    nombre_categoria = input("Ingrese el nombre de la categoría: ")
    
    try:
        cursor = conexion.cursor()
        query = "INSERT INTO categoría (idcategoría, nombre) VALUES (%s, %s)"
        valores = (idcategoria, nombre_categoria)
        
        cursor.execute(query, valores)
        conexion.commit()
        
        print("Registro insertado correctamente en la tabla categoría")
        
    except mysql.connector.Error as error:
        print(f"Error al insertar en la tabla categoría: {error}")
        
    finally:
        cursor.close()
        
def actualizar_categoria():
    idcategoria = input("Ingrese el ID de la categoría: ")
    nombre_categoria = input("Ingrese el nombre de la categoría: ")
    
    try:
        cursor = conexion.cursor()
        query = "UPDATE categoria SET nombre = '%s' WHERE idcategoria = %s;"
        valores = (idcategoria, nombre_categoria)
        
        cursor.execute(query, valores)
        conexion.commit()
        
        print("Registro actualizado correctamente en la tabla categoría")
        
    except mysql.connector.Error as error:
        print(f"Error al actualizar la tabla categoría: {error}")
        
    finally:
        cursor.close()

def iniciar():
    while True:
        print("\n=== Gestión de Categorías ===")
        print("Seleccione una opción:")
        print("1. Crear nueva categoría")
        print("2. Leer categorías existentes")
        print("3. Actualizar una categoría")
        print("4. Eliminar una categoría")
        print("5. Salir")
    
        try:
            choice = int(input("Elige una opción: "))
            if choice == 1:
                insertar_categoria()
            elif choice == 2:
                ()
            elif choice == 3:
                actualizar_categoria()
            elif choice == 4:
                ()
            elif choice == 5:
                print("\n[Mensaje] Saliendo de la gestión de categorías. ¡Hasta pronto!")
                break
            else:
                print("Opción inválida. Por favor, intente nuevamente.")
        except ValueError:
            print("Error: Ingrese un número válido.")

iniciar()
