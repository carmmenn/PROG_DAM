package clases;
import java.util.*;
//sc.nextline lee una línea
//trim ignora los espacios que el usuario mete (los elimina)
//animales existentes
//contains chip ya existe
public class Principal {
		//aquí creo los ArrayList que voy a usar
	    ArrayList<Animal> animales = new ArrayList<>();
	    ArrayList<Adopcion> adopciones = new ArrayList<>();
	    //un input
		Scanner sc = new Scanner (System.in);
		
		//compruebo si ya existe el chip
	    public boolean darAltaAnimal(Animal animal) {
	        for (Animal a : animales) {
	        	//si es igual a cualquier chip ya existente
	            if (a.obtenerChip().equals(animal.obtenerChip())) {
	                System.out.println("Este chip ya existe.");
	                return false;
	            }
	        }
	        //si todo está bien añade el animal al array
	        animales.add(animal);
	        System.out.println("Animal dado de alta.");
	        return true;
	    }
	    
	    //listar animales, que no estaba en la anterior versión
	    public void listarAnimales() {
	    	//si no hay animales
	        if (animales.isEmpty()) {
	            System.out.println("No hay animales registrados.");
	            return;
	        }

	        System.out.println("\nLista de animales registrados:");
	        for (Animal a : animales) {
	            a.mostrar(); //cada animal tiene su mostrar
	        }
	    }

	    
	    //función para buscar al animal
	    public void buscarAnimalPorChip(String chip) {
	        for (Animal a : animales) {
	            if (a.obtenerChip().equals(chip)) {
	                a.mostrar();
	                return;
	            }
	        }
	        //si no coincide la informacion con ningún chip existente
	        System.out.println("No se encuentra este chip.");
	    }
	    
	    //función para comprobar si está ya adoptado o no
	    public Animal buscarAnimalPorChipAdoptado(String chip) {
	        for (Animal a : animales) {
	            if (a.obtenerChip().equals(chip)) {
	                if (a.adoptado) {
	                    System.out.println("Este animal ya ha sido adoptado.");
	                    return null; //el animal ya está adoptado
	                }
	                return a; //animal encontrado y no adoptado
	            }
	        }
	        System.out.println("No se encuentra este chip.");
	        return null; //no existe el animal
	    }
	    
	    //función para adoptar animal
	    public void adoptarAnimal(String chipAdoptar, String nombrePersona, String dniPersona) {
	        Animal animal = buscarAnimalPorChipAdoptado(chipAdoptar); //verifica si el animal está disponible para adopción
	        
	        if (animal != null) {
	            //si el animal existe y no está adoptado
	            animal.adoptado = true; //cambiar el estado
	            
	            //creo una adopcion
	            Adopcion adopcion = new Adopcion(animal, nombrePersona, dniPersona);
	            adopciones.add(adopcion); //añadir la adopción a la lista de adopciones
	            
	            System.out.println("Adopción realizada con éxito.");
	        }
	    }
	    
	    //función para dar de baja
	    public void darDeBajaAnimal(String chip) {
	        Animal animalEliminar = null;

	        //buscar animal por chip (otra vez)
	        for (Animal a : animales) {
	            if (a.obtenerChip().equals(chip)) {
	                animalEliminar = a;
	                break;
	            }
	        }

	        if (animalEliminar == null) {
	            System.out.println("No se encuentra este chip. No se puede dar de baja.");
	            return;
	        }

	        //si estaba adoptado, eliminar su adopción también
	        if (animalEliminar.adoptado) {
	            Adopcion adopcionEliminar = null;
	            for (Adopcion ad : adopciones) {
	                if (ad.obtenerAnimal().equals(animalEliminar)) {
	                    adopcionEliminar = ad;
	                    break;
	                }
	            }

	            if (adopcionEliminar != null) {
	                adopciones.remove(adopcionEliminar);
	                System.out.println("Se eliminaron también los datos de adopción.");
	            }
	        }

	        animales.remove(animalEliminar);
	        System.out.println("Animal dado de baja correctamente.");
	    }
	    
	    //función para mostrar Gatos
	    public void mostrarEstadisticasGatos() {
	        int totalGatos = 0;
	        int gatosLeucemia = 0;

	        for (Animal a : animales) {
	            if (a instanceof Gato) {
	                totalGatos++;
	                Gato g = (Gato) a;
	                if (g.testLeucemia) {
	                    gatosLeucemia++;
	                }
	            }
	        }

	        System.out.println("Número total de gatos: " + totalGatos);
	        System.out.println("Número de gatos con test de leucemia positivo: " + gatosLeucemia);
	    }
	    
	    
//menú
	    //a partir de aquí el menú con los scanner
	    public static void main(String[] args) {
	        Principal sistema = new Principal();
	        Scanner sc = new Scanner(System.in);
	        
	        //he actualizado las opciones con respecto a la anterior versión
	        while (true) {
	            System.out.println("\n1. Dar de alta animal");
	            System.out.println("2. Listar animales");
	            System.out.println("3. Buscar animal por chip");
	            System.out.println("4. Realizar adopción");
	            System.out.println("5. Dar de baja animal");
	            System.out.println("6. Mostrar estadísticas de los gatos");
	            System.out.println("7. Salir");
	            System.out.print("Elige una opción: ");
	            //nextInt lee el siguiente número que el usuario ingrese
	            int opcion = sc.nextInt();
	            sc.nextLine();

//opcion1
		        if (opcion == 1) {
		            System.out.print("Es un perro o gato: ");
		            //toLowerCase convierte a minúsculas todo lo que se escriba, no habrá problema si el usuario escribe mayúsculas
		            String tipo = sc.nextLine().toLowerCase();
		
		            System.out.print("Número de chip: ");
		            String chip = sc.nextLine();
		            System.out.print("Nombre: ");
		            String nombre = sc.nextLine();
		            System.out.print("Edad: ");
		            int edad = sc.nextInt();
		            sc.nextLine();
		            System.out.print("Raza: ");
		            String raza = sc.nextLine();
		            
		            //validar S/N hasta que sea correcto
		            boolean adoptado = false;
		            while (true) {
		            	System.out.print("¿Adoptado? (S/N): ");
		            	String adoptadoSC = sc.nextLine().toUpperCase();
		            	if (adoptadoSC.equals("S")) {
		            		adoptado = true;
		            		break;
		            	} else if (adoptadoSC.equals("N")) {
		            		adoptado = false;
		            		break;
		            	} else {
		            		System.out.println("Escribe solamente S o N.");
		            	}
		            }
		            
		            //si es un perro
	                if (tipo.equals("perro")) {
	                    System.out.print("Tamaño (pequeño/mediano/grande): ");
	                    String tamano = sc.nextLine();
	                    sistema.darAltaAnimal(new Perro(chip, nombre, edad, raza, adoptado, tamano));
	                    
	                //si es un gato
	                } else if (tipo.equals("gato")) {
	                	//validar P/N hasta que sea correcto
	                	boolean leucemia = false;
	                	while (true) {
		                    System.out.print("¿Test de leucemia positivo? (P/N): ");
		                    String leucemiaSC = sc.nextLine().toUpperCase();
		                    if (leucemiaSC.equals("P")) {
		                    	leucemia = true;
		                    	break;
		                    } else if (leucemiaSC.equals("N")) {
		                    	leucemia = false;
		                    	break;
		                    } else {
		                    	System.out.println("Escribe solamente P o N.");
		                    }
	                	}
			            
	                    sistema.darAltaAnimal(new Gato(chip, nombre, edad, raza, adoptado, leucemia));
	                
	                //error
	                } else {
	                    System.out.println("Tipo no válido.");
	                }
//opcion2
		        } else if (opcion == 2) {
		            sistema.listarAnimales();

//opcion3
	            //ya tenía lo de buscar por chip en la anterior versión, así que no hay ningún cambio
	            } else if (opcion == 3) {
	                System.out.print("Introduce el número de chip: ");
	                String chip = sc.nextLine();
	                sistema.buscarAnimalPorChip(chip);
//opcion4
	            //nueva opción adoptar
	            } else if (opcion == 4) {
	                System.out.print("Introduzce el número de chip del animal que desea adoptar: ");
	                String chipAdoptar = sc.nextLine();

	                //pido los datos del nuevo dueño
	                System.out.print("Introduce tu nombre: ");
	                String nombrePersona = sc.nextLine();

	                System.out.print("Introduce tu DNI: ");
	                String dniPersona = sc.nextLine();

	                //llamo a la función de adoptar
	                sistema.adoptarAnimal(chipAdoptar, nombrePersona, dniPersona);
//opcion5
	            //nueva opción dar de baja
	            } else if (opcion == 5) {
	                System.out.print("Introduce el número de chip del animal a dar de baja: ");
	                String chip = sc.nextLine();
	                sistema.darDeBajaAnimal(chip);
	                
	            } else if (opcion == 6) {
	                sistema.mostrarEstadisticasGatos();
		        
	            } else if (opcion == 7) {
	                System.out.println("Vuelve pronto.");
	                //cierro el scanner
	                sc.close();
	                break;

	            } else {
	                System.out.println("No existe esa opción");
	            }
	        }
	    }
}
