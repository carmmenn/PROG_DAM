clientes = {}
pedidos = []
productos = {"Producto A": 10.0, "Producto B": 15.0, "Producto C": 20.0}
archivo_clientes = "clientes.txt"
archivo_pedidos = "pedidos.txt"
contraseña_maestra_admin = "admin1234"  # Contraseña maestra para crear cuentas de administrador


# Cargar datos al inicio
def cargar_datos():
    global clientes, pedidos
    try:
        # Cargar clientes
        with open(archivo_clientes, "r") as f:
            for linea in f:
                tipo, email, nombre, apellido, telefono, contrasena = linea.strip().split(";")
                clientes[email] = {
                    "tipo": tipo,
                    "nombre": nombre,
                    "apellido": apellido,
                    "email": email,
                    "telefono": telefono,
                    "contrasena": contrasena
                }
        # Cargar pedidos
        with open(archivo_pedidos, "r") as f:
            for linea in f:
                numero_pedido, email_cliente, productos_str = linea.strip().split(";")
                productos_pedido = [tuple(p.split(",")) for p in productos_str.split("|")]
                productos_pedido = [(p, float(precio)) for p, precio in productos_pedido]
                pedidos.append({
                    "numero_pedido": numero_pedido,
                    "id_cliente": email_cliente,
                    "productos": productos_pedido
                })
    except FileNotFoundError:
        pass


# Guardar clientes
def guardar_cliente(cliente):
    with open(archivo_clientes, "a") as f:
        f.write(f"{cliente['tipo']};{cliente['email']};{cliente['nombre']};{cliente['apellido']};{cliente['telefono']};{cliente['contrasena']}\n")


# Guardar pedidos
def guardar_pedido(pedido):
    with open(archivo_pedidos, "a") as f:
        productos_str = "|".join([f"{producto},{precio}" for producto, precio in pedido["productos"]])
        f.write(f"{pedido['numero_pedido']};{pedido['id_cliente']};{productos_str}\n")


# Función para registrar un cliente
def registrar_cliente():
    tipo = input("Tipo de cuenta (admin/usuario): ")
   
    # Si es cuenta de administrador, solicitar la contraseña maestra
    if tipo == "admin":
        contrasena_admin = input("Ingrese la contraseña maestra para cuenta de administrador: ")
        if contrasena_admin != contraseña_maestra_admin:
            print("Contraseña maestra incorrecta. No se puede crear la cuenta de administrador.")
            return


    nombre = input("Ingrese nombre: ")
    apellido = input("Ingrese apellido: ")
    email = input("Ingrese email (ID único): ")
    telefono = input("Ingrese teléfono: ")
    contrasena = input("Ingrese contraseña para la cuenta: ")


    # Verificar si el cliente ya existe
    if email in clientes:
        print("Error: Cliente ya registrado.")
        return


    # Registrar cliente en el diccionario y guardar en archivo
    cliente = {
        "tipo": tipo,
        "nombre": nombre,
        "apellido": apellido,
        "email": email,
        "telefono": telefono,
        "contrasena": contrasena
    }
    clientes[email] = cliente
    guardar_cliente(cliente)
    print("Registro exitoso.")


# Función para autenticación de usuario
def iniciar_sesion():
    email = input("Ingrese email: ")
    contrasena = input("Ingrese contraseña: ")
    usuario = clientes.get(email)
    if usuario and usuario["contrasena"] == contrasena:
        print(f"Inicio de sesión exitoso. Bienvenido, {usuario['nombre']}!")
        return usuario
    else:
        print("Credenciales incorrectas.")
        return None


# Función para ver todos los clientes (solo para administradores)
def ver_clientes(usuario):
    if usuario["tipo"] != "admin":
        print("Error: Acceso denegado. Solo administradores pueden ver todos los clientes.")
        return
    if not clientes:
        print("No hay clientes registrados.")
        return
    for id_cliente, datos in clientes.items():
        print(f"ID: {id_cliente} | Nombre: {datos['nombre']} {datos['apellido']}")


# Función para realizar una compra
def realizar_compra(usuario):
    print("Productos disponibles:")
    for producto, precio in productos.items():
        print(f"{producto}: ${precio}")


    # Seleccionar productos
    productos_seleccionados = []
    while True:
        producto = input("Seleccione un producto (o escriba 'fin' para terminar): ")
        if producto == "fin":
            break
        if producto in productos:
            productos_seleccionados.append((producto, productos[producto]))
        else:
            print("Producto no válido.")


    # Registrar el pedido si hay productos seleccionados
    if productos_seleccionados:
        numero_pedido = f"PED-{len(pedidos) + 1}"
        pedido = {
            "numero_pedido": numero_pedido,
            "id_cliente": usuario["email"],
            "productos": productos_seleccionados
        }
        pedidos.append(pedido)
        guardar_pedido(pedido)
        total = sum(precio for _, precio in productos_seleccionados)
        print(f"Compra realizada. Número de pedido: {numero_pedido}. Total: ${total:.2f}")


# Función para seguimiento de pedido
def seguimiento_pedido(usuario):
    numero_pedido = input("Ingrese el número del pedido: ")


    # Buscar el pedido en la lista
    pedido = next((p for p in pedidos if p["numero_pedido"] == numero_pedido), None)


    if not pedido:
        print("Pedido no encontrado.")
        return


    # Verificar permisos
    if usuario["tipo"] != "admin" and pedido["id_cliente"] != usuario["email"]:
        print("Error: Acceso denegado.")
        return


    # Obtener datos del cliente asociado al pedido
    id_cliente = pedido["id_cliente"]
    cliente = clientes[id_cliente]
    print(f"Cliente: {cliente['nombre']} {cliente['apellido']} | Email: {cliente['email']}")
    print("Productos en el pedido:")
    for producto, precio in pedido["productos"]:
        print(f"{producto}: ${precio}")


# Menú principal
def menu():
    cargar_datos()
    print("Bienvenido al sistema de gestión de clientes y pedidos.")
   
    while True:
        usuario = None
        while not usuario:
            print("\n--- Menú de Inicio de Sesión ---")
            print("1. Iniciar sesión")
            print("2. Registrar cliente")
            print("3. Salir")
            opcion = input("Seleccione una opción: ")


            if opcion == "1":
                usuario = iniciar_sesion()
            elif opcion == "2":
                registrar_cliente()
            elif opcion == "3":
                print("Saliendo...")
                return
            else:
                print("Opción no válida.")


        while True:
            print("\n--- Menú Principal ---")
            if usuario["tipo"] == "admin":
                print("1. Ver Clientes")
            print("2. Realizar Compra")
            print("3. Seguimiento de Pedido")
            print("4. Cerrar Sesión")
            print("5. Salir")
            opcion = input("Seleccione una opción: ")


            if opcion == "1" and usuario["tipo"] == "admin":
                ver_clientes(usuario)
            elif opcion == "2":
                realizar_compra(usuario)
            elif opcion == "3":
                seguimiento_pedido(usuario)
            elif opcion == "4":
                print("Cerrando sesión...")
                break  # Regresa al menú de inicio de sesión
            elif opcion == "5":
                print("Saliendo...")
                return
            else:
                print("Opción no válida.")


# Ejecutar el menú
menu()