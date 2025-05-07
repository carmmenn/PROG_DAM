package clases;
import java.util.Scanner;
import java.sql.*;

public class MenuDeInicio {
    // Método que muestra todos los directores (solo nombre y apellido)
    private static void mostrarDirectores(Connection miConexion) {
        try {
            String sql = "SELECT nombre, apellido FROM directores ORDER BY apellido, nombre";
            Statement st = miConexion.createStatement();
            ResultSet rs = st.executeQuery(sql);
            
            System.out.println("Lista de directores existentes:");
            while (rs.next()) {
                System.out.println("- " + rs.getString("nombre") + " " + rs.getString("apellido"));
            }
        } catch (SQLException e) {
            System.out.println("Error al mostrar los directores.");
            e.printStackTrace();
        }
    }

    // Esto va a mostrar toda la tabla de películas
    private static void verPeliculas(Connection miConexion) {
        try {
            // Crear el Statement y ejecutar la consulta con JOIN
            String sql = "SELECT p.titulo, p.anio, p.genero, p.duracion, d.nombre AS nombre_director, d.apellido AS apellido_director " +
                    "FROM peliculas p " +
                    "JOIN directores d ON p.id_director = d.id_director";
            Statement miStatement = miConexion.createStatement();
            ResultSet miResultSet = miStatement.executeQuery(sql);
            // Mostrar los resultados de las películas (he actualizado para que se vean todos los atributos)
            while (miResultSet.next()) {
                System.out.println(
                        miResultSet.getString("titulo") +
                        ", Año: " + miResultSet.getInt("anio") +
                        ", Género: " + miResultSet.getString("genero") +
                        ", Duración: " + miResultSet.getInt("duracion") + " min" +
                        ", Director: " + miResultSet.getString("nombre_director") + " " + miResultSet.getString("apellido_director")
                );
            }
        } catch (SQLException e) {
            System.out.println("Error al mostrar las películas");
            e.printStackTrace();
        }
    }

    private static void aniadirPeliculas(Connection miConexion) {
        Scanner sc = new Scanner(System.in);
        try {
            // Valor inicial por defecto para nuevoId, en caso de que la tabla esté vacía y no haya ningún registro aún.
            String nuevoId = "P001";
            
            // Obtengo el último id_pelicula insertado
            String lastIdQuery = "SELECT id_pelicula FROM peliculas ORDER BY id_pelicula DESC LIMIT 1";
            Statement st = miConexion.createStatement();
            ResultSet rs = st.executeQuery(lastIdQuery);

            if (rs.next()) {
                String lastId = rs.getString("id_pelicula"); // por ejemplo "P013"
                int num = Integer.parseInt(lastId.substring(1)) + 1; // extrae el número y suma 1
                nuevoId = "P" + String.format("%03d", num); // convierte a "P014", "P015", etc.
            }

            // Solicito los datos de la película
            System.out.print("Título de la película: ");
            String titulo = sc.nextLine();

            int anio = 0;
            boolean anioValido = false;
            while (!anioValido) {
                System.out.print("Año de la película: ");
                try {
                    anio = Integer.parseInt(sc.nextLine());
                    anioValido = true;
                } catch (NumberFormatException e) {
                    System.out.println("Por favor, ingresa un número válido para el año.");
                }
            }

            System.out.print("Género de la película: ");
            String genero = sc.nextLine();

            int duracion = 0;
            boolean duracionValida = false;
            while (!duracionValida) {
                System.out.print("Duración (en minutos): ");
                try {
                    duracion = Integer.parseInt(sc.nextLine());
                    duracionValida = true;
                } catch (NumberFormatException e) {
                    System.out.println("Por favor, ingresa un número válido para la duración.");
                }
            }

            System.out.print("Director (nombre completo - nombre y apellido): ");
            String nombreDirector = sc.nextLine();
            String[] nombrePartes = nombreDirector.split(" ");
            String nombre = nombrePartes[0];
            String apellido = nombrePartes[1];

            // Verificar si el director ya existe en la tabla
            String directorExistenteQuery = "SELECT id_director FROM directores WHERE nombre = ? AND apellido = ?";
            PreparedStatement psDirector = miConexion.prepareStatement(directorExistenteQuery);
            psDirector.setString(1, nombre);
            psDirector.setString(2, apellido);
            ResultSet rsDirector = psDirector.executeQuery();

            String idDirector = null;

            if (rsDirector.next()) {
                // Si existe, se obtiene su id
                idDirector = rsDirector.getString("id_director");
            } else {
                // Si no existe, se pregunta si se desea añadir
                System.out.print("El director no existe. ¿Deseas añadirlo? (sí/no): ");
                String respuesta = sc.nextLine();

                if ("sí".equalsIgnoreCase(respuesta)) {
                    // Pido los datos adicionales necesarios para añadir al director
                    System.out.print("Nacionalidad del director: ");
                    String nacionalidadDirector = sc.nextLine();

                    System.out.print("Fecha de nacimiento del director (YYYY-MM-DD): ");
                    String fechaNacimientoDirector = sc.nextLine();

                    // Genero un nuevo id para el director
                    String nuevoIdDirector = "D001";
                    String lastIdDirectorQuery = "SELECT id_director FROM directores ORDER BY id_director DESC LIMIT 1";
                    ResultSet rsIdDirector = st.executeQuery(lastIdDirectorQuery);
                    if (rsIdDirector.next()) {
                        String lastIdDirector = rsIdDirector.getString("id_director"); // por ejemplo "D013"
                        int num = Integer.parseInt(lastIdDirector.substring(1)) + 1;
                        nuevoIdDirector = "D" + String.format("%03d", num); // "D014", etc.
                    }

                    // Insertar el nuevo director
                    String sqlInsertDirector = "INSERT INTO directores (id_director, nombre, apellido, nacionalidad, fecha_nacimiento) " +
                                               "VALUES (?, ?, ?, ?, ?)";
                    PreparedStatement psInsertDirector = miConexion.prepareStatement(sqlInsertDirector);
                    psInsertDirector.setString(1, nuevoIdDirector);
                    psInsertDirector.setString(2, nombre);
                    psInsertDirector.setString(3, apellido);
                    psInsertDirector.setString(4, nacionalidadDirector);
                    psInsertDirector.setString(5, fechaNacimientoDirector);

                    int filasInsertadasDirector = psInsertDirector.executeUpdate();
                    if (filasInsertadasDirector > 0) {
                        System.out.println("Director añadido con éxito.");
                        idDirector = nuevoIdDirector;
                    } else {
                        System.out.println("Error al añadir al director.");
                        return;
                    }
                
                } else {
                    // Si no quiere añadir, mostrar lista y dejar que elija uno existente
                    mostrarDirectores(miConexion);
                    System.out.print("Elige un director existente escribiendo su nombre completo (nombre apellido): ");
                    String nuevoNombreCompleto = sc.nextLine();
                    String[] partes = nuevoNombreCompleto.split(" ");
                    if (partes.length < 2) {
                        System.out.println("Formato incorrecto. Operación cancelada.");
                        return;
                    }
                    String nombreExistente = partes[0];
                    String apellidoExistente = partes[1];

                    PreparedStatement psNuevoDirector = miConexion.prepareStatement(directorExistenteQuery);
                    psNuevoDirector.setString(1, nombreExistente);
                    psNuevoDirector.setString(2, apellidoExistente);
                    ResultSet rsNuevo = psNuevoDirector.executeQuery();
                    if (rsNuevo.next()) {
                        idDirector = rsNuevo.getString("id_director");
                    } else {
                        System.out.println("El director ingresado no existe. Operación cancelada.");
                        return;
                    }
                }
            }

            // Inserto la nueva película en la tabla
            String sql = "INSERT INTO peliculas (id_pelicula, titulo, anio, genero, duracion, id_director) " +
                         "VALUES (?, ?, ?, ?, ?, ?)";
            PreparedStatement miPreparedStatement = miConexion.prepareStatement(sql);
            // Los set introducen los valores que se han obtenido
            miPreparedStatement.setString(1, nuevoId); // ID generado automáticamente
            miPreparedStatement.setString(2, titulo);
            miPreparedStatement.setInt(3, anio);
            miPreparedStatement.setString(4, genero);
            miPreparedStatement.setInt(5, duracion);
            miPreparedStatement.setString(6, idDirector); // ID del director, ya sea existente o recién creado

            // Almaceno las filas
            int filasInsertadas = miPreparedStatement.executeUpdate();
            if (filasInsertadas > 0) {
                System.out.println("Película añadida con éxito.");
            }

        } catch (SQLException e) {
            System.out.println("Error al añadir la película");
            e.printStackTrace();
        }
    }

    // Método para eliminar películas
    private static void eliminarPeliculas(Connection miConexion) {
        Scanner sc = new Scanner(System.in);
        try {
            System.out.print("Título de la película: ");
            String titulo = sc.nextLine();

            String sql = "DELETE FROM peliculas WHERE titulo = ?";
            PreparedStatement miPreparedStatement = miConexion.prepareStatement(sql);
            miPreparedStatement.setString(1, titulo);

            int filasEliminadas = miPreparedStatement.executeUpdate();
            if (filasEliminadas > 0) {
                System.out.println("Película eliminada con éxito.");
            } else {
                System.out.println("No se encontró ninguna película con ese título.");
            }
        } catch (SQLException e) {
            System.out.println("Error al eliminar la película");
            e.printStackTrace();
        }
    }

    // Método para actualizar datos de una película
    private static void actualizarPeliculas(Connection miConexion) {
        Scanner sc = new Scanner(System.in);
        try {
            System.out.print("Título de la película a actualizar: ");
            String titulo = sc.nextLine();

            System.out.println("¿Qué deseas actualizar?");
            System.out.println("1. Año");
            System.out.println("2. Género");
            System.out.println("3. Duración");
            int opcion = 0;
            boolean opcionValida = false;
            while (!opcionValida) {
                System.out.print("Elige una opción: ");
                try {
                    opcion = Integer.parseInt(sc.nextLine());
                    opcionValida = true;
                } catch (NumberFormatException e) {
                    System.out.println("Por favor, ingresa una opción válida.");
                }
            }

            String campo = "";
            String nuevoValor = "";

            switch (opcion) {
                case 1:
                    campo = "anio";
                    System.out.print("Nuevo año: ");
                    nuevoValor = sc.nextLine();
                    break;
                case 2:
                    campo = "genero";
                    System.out.print("Nuevo género: ");
                    nuevoValor = "'" + sc.nextLine() + "'";
                    break;
                case 3:
                    campo = "duracion";
                    System.out.print("Nueva duración (minutos): ");
                    nuevoValor = sc.nextLine();
                    break;
                default:
                    System.out.println("Opción inválida.");
                    return;
            }

            String sql = "UPDATE peliculas SET " + campo + " = " + nuevoValor + " WHERE titulo = ?";
            PreparedStatement ps = miConexion.prepareStatement(sql);
            ps.setString(1, titulo);

            int filasActualizadas = ps.executeUpdate();
            if (filasActualizadas > 0) {
                System.out.println("Película actualizada con éxito.");
            } else {
                System.out.println("No se encontró ninguna película con ese título.");
            }

        } catch (SQLException e) {
            System.out.println("Error al actualizar la película.");
            e.printStackTrace();
        }
    }

    // Método para mostrar el menú y gestionar las opciones
    public static void mostrarMenu(Connection miConexion) {
        Scanner sc = new Scanner(System.in);
        while (true) {
            // Este es el menú que llama a los métodos
            System.out.println("\n1.Ver películas");
            System.out.println("2.Añade una película");
            System.out.println("3.Eliminar una película");
            System.out.println("4.Actualizar una película");
            System.out.println("5.Salir");
            System.out.println("Elige una opción: ");
            int opcion = sc.nextInt();
            sc.nextLine();
            if (opcion == 1) {
                verPeliculas(miConexion);
            } else if (opcion == 2) {
                System.out.println("Añadir película");
                aniadirPeliculas(miConexion);
            } else if (opcion == 3) {
                System.out.println("Eliminar película");
                eliminarPeliculas(miConexion);
            } else if (opcion == 4) {
                System.out.println("Actualizar película");
                actualizarPeliculas(miConexion);
            } else if (opcion == 5) {
                System.out.println("Vuelve pronto.");
                sc.close();
                break;
            } else {
                System.out.println("No existe esa opción");
            }
        }
    }
}
