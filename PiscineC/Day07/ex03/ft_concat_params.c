/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_concat_params.c                                 :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/15 22:08:08 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/16 11:10:44 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <stdlib.h>

char	*ft_concat_params(int argc, char **argv)
{
	char	*tab;
	int		i;
	int		j;
	int		k;

	if (argc == 0)
		return (0);
	if ((tab = (char*)malloc(sizeof(*tab) * (argc + 1))) == NULL)
		return (0);
	i = 0;
	k = 1;
	while (k < argc)
	{
		j = 0;
		while (argv[k][j])
		{
			tab[i] = argv[k][j];
			j++;
			i++;
		}
		tab[i++] = '\n';
		k++;
	}
	tab[i - 1] = '\0';
	return (tab);
}
