package clases;

public class Gato extends Animal {
	boolean testLeucemia;
	
	public Gato (String chip, String nombre, int edad, String raza, boolean adoptado, boolean testLeucemia) {
		super(chip, nombre, edad, raza, adoptado);
		this.testLeucemia = testLeucemia;
	}
	
	@Override
	public void mostrar() {
		System.out.println("Gato: " + nombre + "\nChip:" + chip + "\nEdad:" + edad + "\nRaza:" + raza + "\nAdoptado:" + adoptado + "\nTest Leucemia:" + testLeucemia);
		
	}
}
