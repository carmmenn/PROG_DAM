def obtener_saldo_inicial():  # Solicita el saldo inicial de la cuenta, validando que no sea negativo.
    while True:
        saldo = float(input("Introduce el saldo inicial de la cuenta: "))
        if saldo >= 0:  # Solo permite un saldo mayor o igual a cero.
            return saldo
        else:
            print("El saldo no puede ser negativo. Inténtalo de nuevo.")

def mostrar_menu():  # Muestra el menú con las opciones disponibles.
    print("--- Menú ---")
    print("1. Ingresar dinero")
    print("2. Retirar dinero")
    print("3. Mostrar saldo")
    print("4. Estadísticas")
    print("5. Salir")

def obtener_opcion():  # Solicita y valida la opción seleccionada por el usuario.
    while True:
        opcion = int(input("Elige una opción: "))
        if opcion in [1, 2, 3, 4, 5]:  # Solo permite las opciones válidas.
            return opcion
        else:
            print("Opción incorrecta. Inténtalo de nuevo.")

def ingresar_dinero(saldo):  # Permite ingresar dinero, validando que no sea negativo.
    while True:
        ingreso = float(input("Cantidad a ingresar: "))
        if ingreso > 0:  # Solo acepta ingresos mayores a cero.
            saldo += ingreso
            return saldo, ingreso  # Devuelve el saldo actualizado y el ingreso.
        else:
            print("No se pueden ingresar cantidades negativas o cero.")

def retirar_dinero(saldo):  # Permite retirar dinero, verificando que no deje el saldo en negativo.
    while True:
        retiro = float(input("Cantidad a retirar: "))
        if retiro > 0:  # Solo permite retiros mayores a cero.
            if saldo - retiro >= 0:  # Verifica que haya suficiente saldo para la retirada.
                saldo -= retiro
                return saldo, retiro  # Devuelve el saldo actualizado y la cantidad retirada.
            else:
                print("No puedes retirar más de lo que tienes en la cuenta.")
        else:
            print("La cantidad a retirar debe ser mayor que cero.")

def mostrar_saldo(saldo):  # Muestra el saldo actual de la cuenta.
    print(f"Saldo actual: {saldo}€")

def mostrar_estadisticas(ingresos, retiradas):  # Muestra el número de ingresos y retiradas realizados.
    print(f"Número de ingresos: {ingresos}")
    print(f"Número de retiradas: {retiradas}")

def simulacion_bancaria():  # Función principal que ejecuta la simulación bancaria.
    saldo = obtener_saldo_inicial()  # Solicita el saldo inicial de la cuenta.
    ingresos = 0  # Contador de ingresos.
    retiradas = 0  # Contador de retiradas.

    while True:  # Ciclo principal del programa.
        mostrar_menu()  # Muestra el menú con las opciones.
        opcion = obtener_opcion()  # Solicita la opción del menú.

        if opcion == 1:  # Opción de ingresar dinero.
            saldo, ingreso = ingresar_dinero(saldo)  # Actualiza el saldo con el ingreso.
            ingresos += 1  # Incrementa el contador de ingresos.
            print(f"Has ingresado {ingreso}€. Saldo actual: {saldo}€")
        
        elif opcion == 2:  # Opción de retirar dinero.
            saldo, retiro = retirar_dinero(saldo)  # Actualiza el saldo con la retirada.
            retiradas += 1  # Incrementa el contador de retiradas.
            print(f"Has retirado {retiro}€. Saldo actual: {saldo}€")
        
        elif opcion == 3:  # Opción de mostrar el saldo.
            mostrar_saldo(saldo)

        elif opcion == 4:  # Opción de mostrar las estadísticas.
            mostrar_estadisticas(ingresos, retiradas)

        elif opcion == 5:  # Opción de salir del programa.
            print("Gracias por usar el simulador bancario. ¡Hasta pronto!")
            break  # Finaliza el ciclo y el programa.

# Ejecuta la simulación bancaria.
simulacion_bancaria()