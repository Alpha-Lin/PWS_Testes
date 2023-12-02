package Whole.wordCloud;

import Whole.daoPackage.TagDAO;

import javafx.scene.control.Alert;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.nio.file.Files;
import java.nio.file.Paths;


public class cloudWordGenerator {
    public static void main(String[] args) {
        try {
            String texte = TagDAO.tagAndSize();
            String path = "src/main/wordcloud/text.txt";
            Files.write(Paths.get(path), texte.getBytes());
            ProcessBuilder process = new ProcessBuilder("python", "src/main/wordcloud/cloud.py").inheritIO();
            Process p = process.start();
            p.waitFor();
            BufferedReader Buffered_Reader = new BufferedReader(
                    new InputStreamReader(
                            p.getInputStream()
                    ));
            String Output_line = "";
            while ((Output_line = Buffered_Reader.readLine()) != null) {
                System.out.println(Output_line);
            }
        }
        catch (IOException | InterruptedException i) {
            i.printStackTrace();
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setTitle("Une erreur est survenue");
            alert.setHeaderText("Une erreur est survenue durant la création du nuage");
            alert.setContentText("Il est nécessaire d'avoir Python installé ainsi que matplotlib.pyplot, worldcloud et random");
            alert.show();
            i.printStackTrace();
        }
    }
}
