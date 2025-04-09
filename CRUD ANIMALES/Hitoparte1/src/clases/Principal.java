package clases;
import java.util.*;
//sc.nextline lee una línea
//trim ignora los espacios que el usuario mete (los elimina)
//animales existentes
//contains chip ya existe
public class Principal {
	    ArrayList<Animal> animales = new ArrayList<>();
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
	    
	    //a partir de aquí el menú con los scanner
	    public static void main(String[] args) {
	        Principal sistema = new Principal();
	        Scanner sc = new Scanner(System.in);

	        while (true) {
	            System.out.println("\n1. Dar de alta animal");
	            System.out.println("2. Buscar animal por chip");
	            System.out.println("3. Salir");
	            System.out.print("Elige una opción: ");
	            //nextInt lee el siguiente número que el usuario ingrese
	            int opcion = sc.nextInt();
	            sc.nextLine();
		    
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

	            } else if (opcion == 2) {
	                System.out.print("Introduce el número de chip: ");
	                String chip = sc.nextLine();
	                sistema.buscarAnimalPorChip(chip);

	            } else if (opcion == 3) {
	                System.out.println("Vuelve pronto.");
	                break;

	            } else {
	                System.out.println("No existe esa opción");
	            }
	        }
	    }
}
