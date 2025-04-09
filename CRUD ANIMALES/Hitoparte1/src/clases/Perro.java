package clases;

public class Perro extends Animal {
    private String tamano;

    public Perro(String chip, String nombre, int edad, String raza, boolean adoptado, String tamano) {
        super(chip, nombre, edad, raza, adoptado);
        this.tamano = tamano;
    }
    
    @Override
    public void mostrar() {
        System.out.println("Perro: " + nombre + "\nChip: " + chip + ", \nEdad: " + edad + ", \nRaza: " + raza + ", \nAdoptado: " + adoptado + ", \nTamaño: " + tamano);
    }
}

