/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   shit.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/05/20 16:51:04 by jmondino          #+#    #+#             */
/*   Updated: 2019/05/21 08:08:41 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "ft_ls.h"

void	ft_oneac(DIR *pDir, struct dirent *pDirent)
{
	pDir = opendir("./");			//Dossier actuel
  	ft_parse(pDir, pDirent);		//tri ascii et fichier caché
   	closedir (pDir);
	printf("\n");
}

void	ft_manyac(DIR *pDir, struct dirent *pDirent, int ac, char **av)
{
	int		i;

	i = 1;
    while (i != ac)
    {
        pDir = opendir (av[i]);
        if (pDir == NULL)
        {
            printf ("Cannot open directory '%s'\n", av[i]);
            exit(1);
        }
        if (ac > 2)
            printf("%s:\n", av[i]);
        ft_parse(pDir, pDirent);		//tri ascii et fichier caché
        closedir (pDir);
        i ++;
        printf("\n");
        if (i != ac)
            printf("\n");
	}
}

int		ft_strlen(char *str)
{
	int		i;

	i = 0;
	while (str[i])
		i++;
	return i;
}

void	ft_parse(DIR *pDir, struct dirent *pDirent)
{
	char	**tab;
	char	*tmp;
	int		i;

	tab = (char **)malloc(sizeof(char *) * 999); // degueu mais je sais pas comment faire autrement
	i = 0;
	while ((pDirent = readdir(pDir)) != NULL)
	{
		tab[i] = (char *)malloc(sizeof(char) * ft_strlen(pDirent->d_name)); 
		tab[i] = pDirent->d_name;
		i++;
	}
	tab[i] = NULL;
	i = 0;
	while (tab[i])
	{
		printf("%s ", tab[i]);
		i++;
	}
}
