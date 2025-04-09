package clases;

public class Adopcion {
    Animal animal;
    String nombrePersona;
    String dniPersona;
    
	public Adopcion(Animal animal, String nombrePersona, String dniPersona) {
	    this.animal = animal;
	    this.nombrePersona = nombrePersona;
	    this.dniPersona = dniPersona;
	}
	
	public Animal obtenerAnimal() {
	    return animal;
	}
}
