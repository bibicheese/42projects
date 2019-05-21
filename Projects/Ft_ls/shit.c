/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   shit.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/05/20 16:51:04 by jmondino          #+#    #+#             */
/*   Updated: 2019/05/21 17:01:17 by jmondino         ###   ########.fr       */
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

char	**ft_createtab(t_list *lst, int i)
{
	char	**tab;
	char	*tmp;
	t_list	*temp;
	int		j;

	j = 0;
	tab = (char **)malloc(sizeof(char *) * i + 1);
	temp = lst;
	while (temp)
	{
		if (temp->content[0] == '.')
			temp = temp->next;
		else
		{
			tab[j] = (char *)malloc(sizeof(char) * ft_strlen(temp->content));
			tab[j] = temp->content;
			j++;
			temp = temp->next;
		}
	}
	j = 0;
	while (tab[j])
	{
		i = j + 1;
		while (tab[i])
		{
			if (tab[i] < tab[j])
			{
				tmp = tab[i];
				tab[i] = tab[j];
				tab[j] = tmp;
			}
			i++;
		}
		j++;
	}
	return tab;
}

void	ft_parse(DIR *pDir, struct dirent *pDirent)
{
	t_list	*lst;
	t_list	*tmp;
	char	**tab;
	int		i;

	i = 0;
	while ((pDirent = readdir(pDir)))
	{
		if (!(lst))
			lst = ft_lstnew(pDirent->d_name, ft_strlen(pDirent->d_name)); 
		else
			ft_lstadd(&lst, ft_lstnew(pDirent->d_name, ft_strlen(pDirent->d_name)));
	}
	tmp = lst;
	while (tmp)
	{
		tmp = tmp->next;
		i++;
	}
	tab = ft_createtab(lst, i);
	ft_afftab(tab);
}

void	ft_afftab(char **tab)
{
	int		i = 0;
	int		length = 0;
	int		tmp;

	while (tab[i])
	{
		if (length < ft_strlen(tab[i]))
			length = ft_strlen(tab[i]);
		i++;
	}
	i = 0;
	while (tab[i])
	{
		printf("%s ", tab[i]);
		tmp = (length - ft_strlen(tab[i]));
		while (tmp != 0)
		{
			printf(" ");
			tmp--;
		}
		i++;
	}
}
