def mostrar_menu():
    print("MENU")
    print("1 - Cuadrado")
    print("2 - Rectángulo")
    print("Escriba 'EXIT' para salir del menú")
   
def obtener_opcion(): #El programa imprime el menú y solicita una opción al usuario.
    while True:
        opcion = input("Dime una opción ")
        if opcion in ["1", "2"]:
            return int(opcion)
        elif opcion == "EXIT":  # Permite salir del menú si se escribe "EXIT"
            return opcion
        else:
            print("Esta opción no está disponible") #Si el usuario ingresa una opción incorrecta, el programa sigue pidiendo hasta que se ingrese una opción válida (1 o 2).

def mostrar_cuadrado(lado): #Si el usuario selecciona "1", se solicita el lado del cuadrado, se dibuja la figura y se calculan el área y el perímetro.
    print("Cuadrado:")
    for _ in range(lado):
        print("*  " *lado)
   
    area = lado ** 2
    perimetro = 4 * lado
    print(f"Área: {area}")
    print(f"Perímetro: {perimetro}")


def mostrar_rectangulo(base, altura): #Si el usuario selecciona "2", se solicitan la base y la altura, se dibuja el rectángulo, y se calculan el área y el perímetro.
    print("Rectángulo:")
    for _ in range(altura):
        print("* " * base)
   
    area = base * altura
    perimetro = 2 * (base + altura)
    print(f"Área: {area}")
    print(f"Perímetro: {perimetro}")


def ejecución(): # Muestra el menú, solicita la opción y según el caso, pide los datos y muestra la figura, área y perímetro.
    while True:
        mostrar_menu()
        opcion = obtener_opcion()
        if opcion == 1:
            lado = int(input("Introduce el lado del cuadrado: "))
            mostrar_cuadrado(lado)
        elif opcion == 2:
            base = int(input("Introduce la base del rectángulo: "))
            altura = int(input("Introduce la altura del rectángulo: "))
            mostrar_rectangulo(base, altura)
        elif opcion == "EXIT":  # Si el usuario ingresa 'EXIT', se sale del bucle y del programa.
            print("Ha salido del programa.")
            break

ejecución()