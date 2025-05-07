package clases;
import java.sql.*;
public class ConexionBDD {
   public static void main(String[] args) {
       try {
           Connection miConexion = DriverManager.getConnection("jdbc:mysql://localhost:3307/cine_carmen_perez_puente", "root", "");
           System.out.println("Conexión exitosa a la base de datos.");
          
           // Llamamos al menú de inicio
           MenuDeInicio.mostrarMenu(miConexion);
       } catch (Exception e) {
           System.out.println("No se ha podido acceder a la base de datos");
           e.printStackTrace();
       }
   }
}
