package clases;

import java.util.Scanner;
import java.sql.*;

public class MenuDeInicio {
    // Método para mostrar el menú y gestionar las opciones
    public static void mostrarMenu(Connection miConexion) {
        Scanner sc = new Scanner(System.in);

        while (true) {
            System.out.println("\n1.Ver películas");
            System.out.println("2.Salir");
            System.out.print("Elige una opción: ");
            int opcion = sc.nextInt();
            sc.nextLine();

            if (opcion == 1) {
                verPeliculas(miConexion); // Llamo a verPeliculas()
            } else if (opcion == 2) {
                System.out.println("Vuelve pronto.");
                sc.close();
                break;
            } else {
                System.out.println("No existe esa opción");
            }
        }
    }

    // Esto va a mostrar toda la tabla de películas
    private static void verPeliculas(Connection miConexion) {
        try {
            // Crear el Statement y ejecutar la consulta
            Statement miStatement = miConexion.createStatement();
            ResultSet miResultSet = miStatement.executeQuery("SELECT * FROM peliculas");

            // Mostrar los resultados de las películas
            while (miResultSet.next()) {
                System.out.println(miResultSet.getString("titulo") + " " + miResultSet.getInt("anio"));
            }

        } catch (SQLException e) {
            System.out.println("Error al mostrar las películas");
            e.printStackTrace();
        }
    }
}
