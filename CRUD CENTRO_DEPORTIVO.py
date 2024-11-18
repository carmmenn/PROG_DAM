import mysql.connector

# Función para conectar con la base de datos MySQL
def conectar():
    """Establece y devuelve una conexión a la base de datos CENTRO_DEPORTIVO."""
    conexion = mysql.connector.connect(
        host="localhost",
        user="root",
        password="curso",
        database="CENTRO_DEPORTIVO"
    )
    return conexion

# CRUD Clientes
def crear_cliente():
    try:
        conexion = conectar()
        cursor = conexion.cursor()
        nombre = input("Ingrese el nombre del cliente: ")
        
        # Validación de la edad
        while True:
            try:
                edad = int(input("Ingrese la edad: "))
                if edad < 18:
                    print("La edad debe ser mayor o igual a 18.")
                    continue
                break
            except ValueError:
                print("Por favor, ingrese un número válido para la edad.")
        
        tipo_membresia = input("Ingrese el tipo de membresía: ")
        cursor.execute("INSERT INTO clientes (nombre, edad, tipo_membresia) VALUES (%s, %s, %s)", 
                       (nombre, edad, tipo_membresia))
        conexion.commit()
        print("[Mensaje]: Cliente registrado exitosamente.")
    except mysql.connector.Error as err:
        print(f"[Error]: Ocurrió un error: {err}")
    finally:
        cursor.close()
        conexion.close()

def listar_clientes():
    conexion = conectar()
    cursor = conexion.cursor()
    cursor.execute("SELECT * FROM clientes")
    resultados = cursor.fetchall()
    print("ID | Nombre         | Edad | Membresía")
    print("---------------------------------------")
    for cliente in resultados:
        print(f"{cliente[0]} | {cliente[1]:<15} | {cliente[2]}   | {cliente[3]}")
    cursor.close()
    conexion.close()

def actualizar_cliente():
    try:
        conexion = conectar()
        cursor = conexion.cursor()
        id_cliente = int(input("Ingrese el ID del cliente a actualizar: "))
        nuevo_nombre = input("Ingrese el nuevo nombre: ")
        nueva_edad = int(input("Ingrese la nueva edad: "))
        nuevo_tipo_membresia = input("Ingrese el nuevo tipo de membresía: ")
        cursor.execute("""UPDATE clientes SET nombre = %s, edad = %s, tipo_membresia = %s WHERE id_cliente = %s""",
                       (nuevo_nombre, nueva_edad, nuevo_tipo_membresia, id_cliente))
        conexion.commit()
        print("[Mensaje]: Cliente actualizado exitosamente.")
    except mysql.connector.Error as err:
        print(f"[Error]: Ocurrió un error: {err}")
    finally:
        cursor.close()
        conexion.close()

def eliminar_cliente():
    try:
        conexion = conectar()
        cursor = conexion.cursor()
        id_cliente = int(input("Ingrese el ID del cliente a eliminar: "))
        cursor.execute("DELETE FROM inscripciones WHERE id_cliente = %s", (id_cliente,))
        cursor.execute("DELETE FROM clientes WHERE id_cliente = %s", (id_cliente,))
        conexion.commit()
        print("[Mensaje]: Cliente eliminado exitosamente.")
    except mysql.connector.Error as err:
        print(f"[Error]: Ocurrió un error: {err}")
    finally:
        cursor.close()
        conexion.close()

# CRUD Actividades
def crear_actividad():
    try:
        nombre_actividad = input("Ingrese el nombre de la actividad: ")
        horario = input("Ingrese el horario: ")
        duracion = int(input("Ingrese la duración (en minutos): "))
        id_entrenador = int(input("Ingrese el ID del entrenador: "))
        conn = conectar()
        cursor = conn.cursor()
        cursor.execute("""
            INSERT INTO actividades (nombre_actividad, horario, duracion, id_entrenador)
            VALUES (%s, %s, %s, %s)
        """, (nombre_actividad, horario, duracion, id_entrenador))
        conn.commit()
        print("[Mensaje]: Actividad registrada exitosamente.")
    except mysql.connector.Error as err:
        print(f"[Error]: Ocurrió un error: {err}")
    finally:
        conn.close()

def leer_actividades():
    conn = conectar()
    cursor = conn.cursor()
    cursor.execute("""
        SELECT a.id_actividad, a.nombre_actividad, a.horario, a.duracion, e.nombre_entrenador
        FROM actividades a
        JOIN entrenadores e ON a.id_entrenador = e.id_entrenador
    """)
    actividades = cursor.fetchall()
    print("\nID Actividad | Nombre     | Horario     | Duración | Entrenador")
    print("--------------------------------------------------------------")
    for actividad in actividades:
        print(f"{actividad[0]}            | {actividad[1]}    | {actividad[2]} | {actividad[3]} min | {actividad[4]}")
    conn.close()

def actualizar_actividad():
    try:
        id_actividad = int(input("Ingrese el ID de la actividad a actualizar: "))
        nombre_actividad = input("Nuevo nombre de actividad: ")
        horario = input("Nuevo horario: ")
        duracion = int(input("Nueva duración (en minutos): "))
        id_entrenador = int(input("Nuevo ID de entrenador: "))
        conn = conectar()
        cursor = conn.cursor()
        cursor.execute("""
            UPDATE actividades
            SET nombre_actividad = %s, horario = %s, duracion = %s, id_entrenador = %s
            WHERE id_actividad = %s
        """, (nombre_actividad, horario, duracion, id_entrenador, id_actividad))
        conn.commit()
        print("[Mensaje]: Actividad actualizada exitosamente.")
    except mysql.connector.Error as err:
        print(f"[Error]: Ocurrió un error: {err}")
    finally:
        conn.close()

def eliminar_actividad():
    try:
        id_actividad = int(input("Ingrese el ID de la actividad a eliminar: "))
        conn = conectar()
        cursor = conn.cursor()
        cursor.execute("DELETE FROM inscripciones WHERE id_actividad = %s", (id_actividad,))
        cursor.execute("DELETE FROM actividades WHERE id_actividad = %s", (id_actividad,))
        conn.commit()
        print("[Mensaje]: Actividad eliminada exitosamente.")
    except mysql.connector.Error as err:
        print(f"[Error]: Ocurrió un error: {err}")
    finally:
        conn.close()

# CRUD Entrenadores
def crear_entrenador():
    try:
        nombre_entrenador = input("Ingrese el nombre del entrenador: ")
        especialidad = input("Ingrese la especialidad del entrenador (Ej: Yoga, Pesas): ")
        conn = conectar()
        cursor = conn.cursor()
        cursor.execute("""
            INSERT INTO entrenadores (nombre_entrenador, especialidad)
            VALUES (%s, %s)
        """, (nombre_entrenador, especialidad))
        conn.commit()
        print("[Mensaje]: Entrenador registrado exitosamente.")
    except mysql.connector.Error as err:
        print(f"[Error]: Ocurrió un error: {err}")
    finally:
        conn.close()

def leer_entrenadores():
    conn = conectar()
    cursor = conn.cursor()
    cursor.execute("SELECT * FROM entrenadores")
    entrenadores = cursor.fetchall()
    print("\nID Entrenador | Nombre      | Especialidad")
    print("--------------------------------------------")
    for entrenador in entrenadores:
        print(f"{entrenador[0]}          | {entrenador[1]}   | {entrenador[2]}")
    conn.close()

def actualizar_entrenador():
    try:
        id_entrenador = int(input("Ingrese el ID del entrenador a actualizar: "))
        nombre_entrenador = input("Nuevo nombre: ")
        especialidad = input("Nueva especialidad: ")
        conn = conectar()
        cursor = conn.cursor()
        cursor.execute("""
            UPDATE entrenadores
            SET nombre_entrenador = %s, especialidad = %s
            WHERE id_entrenador = %s
        """, (nombre_entrenador, especialidad, id_entrenador))
        conn.commit()
        print("[Mensaje]: Entrenador actualizado exitosamente.")
    except mysql.connector.Error as err:
        print(f"[Error]: Ocurrió un error: {err}")
    finally:
        conn.close()

def eliminar_entrenador():
    try:
        id_entrenador = int(input("Ingrese el ID del entrenador a eliminar: "))
        conn = conectar()
        cursor = conn.cursor()
        # Primero eliminamos las actividades que dependen de este entrenador
        cursor.execute("UPDATE actividades SET id_entrenador = NULL WHERE id_entrenador = %s", (id_entrenador,))
        # Ahora eliminamos al entrenador
        cursor.execute("DELETE FROM entrenadores WHERE id_entrenador = %s", (id_entrenador,))
        conn.commit()
        print("[Mensaje]: Entrenador eliminado exitosamente.")
    except mysql.connector.Error as err:
        print(f"[Error]: Ocurrió un error: {err}")
    finally:
        conn.close()

# Menú principal
def menu_principal():
    while True:
        print("\n=== Gestión del Centro Deportivo ===")
        print("1. Gestión de Clientes")
        print("2. Gestión de Actividades")
        print("3. Gestión de Entrenadores")
        print("4. Gestión de Inscripciones")
        print("5. Salir")
        opcion = input("Seleccione una opción: ")

        if opcion == "1":
            while True:
                print("\n=== Gestión de Clientes ===")
                print("1. Crear cliente")
                print("2. Listar cliente")
                print("3. Actualizar cliente")
                print("4. Eliminar cliente")
                print("5. Volver al menú principal")
                opcion_cliente = input("Seleccione una opción: ")

                if opcion_cliente == "1":
                    crear_cliente()
                elif opcion_cliente == "2":
                    listar_clientes()
                elif opcion_cliente == "3":
                    actualizar_cliente()
                elif opcion_cliente == "4":
                    eliminar_cliente()
                elif opcion_cliente == "5":
                    break
                else:
                    print("[Error]: Opción no válida.")
        
        elif opcion == "2":
            while True:
                print("\n=== Gestión de Actividades ===")
                print("1. Crear actividad")
                print("2. Listar actividades")
                print("3. Actualizar actividad")
                print("4. Eliminar actividad")
                print("5. Volver al menú principal")
                opcion_actividad = input("Seleccione una opción: ")

                if opcion_actividad == "1":
                    crear_actividad()
                elif opcion_actividad == "2":
                    leer_actividades()
                elif opcion_actividad == "3":
                    actualizar_actividad()
                elif opcion_actividad == "4":
                    eliminar_actividad()
                elif opcion_actividad == "5":
                    break
                else:
                    print("[Error]: Opción no válida.")
        
        elif opcion == "3":
            while True:
                print("\n=== Gestión de Entrenadores ===")
                print("1. Crear entrenador")
                print("2. Listar entrenadores")
                print("3. Actualizar entrenador")
                print("4. Eliminar entrenador")
                print("5. Volver al menú principal")
                opcion_entrenador = input("Seleccione una opción: ")

                if opcion_entrenador == "1":
                    crear_entrenador()
                elif opcion_entrenador == "2":
                    leer_entrenadores()
                elif opcion_entrenador == "3":
                    actualizar_entrenador()
                elif opcion_entrenador == "4":
                    eliminar_entrenador()
                elif opcion_entrenador == "5":
                    break
                else:
                    print("[Error]: Opción no válida.")
        
        elif opcion == "5":
            print("¡Hasta luego!")
            break
        else:
            print("[Error]: Opción no válida.")

# Llamada al menú principal
menu_principal()
