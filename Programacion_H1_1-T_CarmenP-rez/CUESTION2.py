import random

def mostrar_menu(): # Muestra el menú de opciones al usuario.
    print("Elige 1-Piedra | 2-Papel | 3-Tijera")

def obtener_opcion_usuario(): # Solicita y valida la opción del usuario (1, 2 o 3).
    while True:
        opcion = int(input("> "))
        if opcion in [1, 2, 3]:
            return opcion
        else:
            print("Opción incorrecta. Inténtalo de nuevo.")

def obtener_opcion_maquina(): # Genera una opción aleatoria para la máquina (1, 2 o 3).
    return random.randint(1, 3)

def jugar_una_ronda(usuario, maquina): # Juega una ronda comparando las opciones del usuario y la máquina.
    opciones = {1: "piedra", 2: "papel", 3: "tijera"} # Diccionario que asigna nombres a las opciones.
    print(f"El jugador ha elegido {opciones[usuario]}") # Muestra la elección del usuario.
    print(f"La máquina ha elegido {opciones[maquina]}") # Muestra la elección de la máquina.

    if usuario == maquina: # Caso de empate.
        print("Habeis empatado")
        return 0
    elif (usuario == 1 and maquina == 3) or (usuario == 2 and maquina == 1) or (usuario == 3 and maquina == 2): # Caso de victoria del usuario.
        print("Has ganado!! :)")
        return 1
    else: # Caso de derrota del usuario.
        print("Has perdido!! :)")
        return -1

def jugar(): # Controla el juego completo, cuenta las puntuaciones y determina el ganador final.
    puntuacion_usuario = 0 # Inicializa la puntuación del usuario.
    puntuacion_maquina = 0 # Inicializa la puntuación de la máquina.

    while puntuacion_usuario < 3 and puntuacion_maquina < 3: # Juega hasta que alguien gane 3 veces.
        mostrar_menu() # Muestra el menú de opciones.
        opcion_usuario = obtener_opcion_usuario() # Solicita la opción del usuario.
        opcion_maquina = obtener_opcion_maquina() # Genera la opción de la máquina.

        resultado = jugar_una_ronda(opcion_usuario, opcion_maquina) # Juega una ronda y obtiene el resultado.

        if resultado == 1: # Si el usuario gana, se incrementa su puntuación.
            puntuacion_usuario += 1
        elif resultado == -1: # Si la máquina gana, se incrementa su puntuación.
            puntuacion_maquina += 1

        print(f"Puntuación - Jugador: {puntuacion_usuario}, Máquina: {puntuacion_maquina}") # Muestra las puntuaciones actuales.
    
    if puntuacion_usuario == 3: # Si el usuario alcanza 3 puntos, gana la partida.
        print("Has ganado la partida.")
    else: # Si la máquina alcanza 3 puntos, gana la partida.
        print("La máquina ha ganado la partida.")

jugar() # Inicia el juego.